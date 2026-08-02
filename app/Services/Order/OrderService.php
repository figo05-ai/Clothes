<?php

namespace App\Services\Order;

use App\Contracts\Order\OrderServiceInterface;
use App\Contracts\Cart\CartServiceInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        protected CartServiceInterface $cartService
    ) {}

    /**
     * Process checkout and create an order from the user's cart.
     */
    public function checkout(array $checkoutData, ?string $userId = null)
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            throw new Exception("Cart is empty. Cannot proceed with checkout.");
        }

        return DB::transaction(function () use ($cart, $checkoutData, $userId) {
            $totalAmount = 0;
            $orderItemsData = [];

            // 1. Calculate totals and prepare order items
            foreach ($cart as $productId => $item) {
                // Ensure product exists and has stock (Lock for update if needed)
                $product = Product::lockForUpdate()->find($productId);
                
                if (!$product) {
                    throw new Exception("Product {$item['name']} no longer exists.");
                }

                if ($product->stock_quantity < $item['quantity']) {
                    throw new Exception("Insufficient stock for product: {$product->name}");
                }

                $subtotal = $product->base_price * $item['quantity'];
                $totalAmount += $subtotal;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->base_price,
                    'total_price' => $subtotal,
                ];

                // Deduct stock
                $product->stock_quantity -= $item['quantity'];
                $product->save();
            }

            // 2. Create the Order
            $shippingFee = $checkoutData['shipping_cost'] ?? 0;
            $taxAmount = $checkoutData['tax_amount'] ?? 0;
            $discountAmount = $checkoutData['discount_amount'] ?? 0;

            // Redeem loyalty points if requested
            if (!empty($checkoutData['redeem_points']) && $userId) {
                $loyaltyService = app(\App\Contracts\Loyalty\LoyaltyServiceInterface::class);
                $pointsDiscount = $loyaltyService->redeemPoints($userId, (int) $checkoutData['redeem_points']);
                $discountAmount += $pointsDiscount;
            }

            $grandTotal = max(0, $totalAmount + $shippingFee + $taxAmount - $discountAmount);

            // Check if paying with wallet
            if (($checkoutData['payment_method'] ?? '') === 'wallet') {
                if (!$userId) {
                    throw new Exception("Must be logged in to pay with wallet.");
                }
                $walletService = app(\App\Contracts\Wallet\WalletServiceInterface::class);
                
                if (!$walletService->isActive($userId)) {
                    throw new Exception("Your wallet is currently disabled. Please enable it in your account settings to use it for payment.");
                }

                $balance = $walletService->getBalance($userId);
                
                if ($balance < $grandTotal) {
                    throw new Exception("Insufficient wallet balance. You need $" . number_format($grandTotal, 2) . " but have $" . number_format($balance, 2));
                }
                
                // Deduct from wallet using Admin interface since customer service doesn't have deduct
                app(\App\Contracts\Wallet\AdminWalletServiceInterface::class)->deductCredit($userId, (float) $grandTotal, "Payment for order");
            }

            $order = Order::create([
                'user_id' => $userId, // Can be null for guest checkout
                'order_number' => strtoupper(uniqid('ORD-')),
                'subtotal_amount' => $totalAmount,
                'discount_amount' => $discountAmount,
                'shipping_fee' => $shippingFee,
                'tax_amount' => $taxAmount,
                'grand_total' => $grandTotal,
                'status' => 'pending',
                // For simplicity, we are ignoring address linking for now or saving as JSON in notes if needed
                'notes' => json_encode([
                    'shipping_address' => $checkoutData['shipping_address'] ?? 'Pending',
                    'billing_address' => $checkoutData['billing_address'] ?? 'Pending',
                    'payment_method' => $checkoutData['payment_method'] ?? 'cash_on_delivery',
                ]),
            ]);

            // 3. Create Order Items
            foreach ($orderItemsData as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            // 4. Clear the cart
            $this->cartService->clear();

            return $order;
        });
    }

    /**
     * Get details of a specific order.
     */
    public function getOrderDetails(string $orderId)
    {
        return Order::with('items.product')->findOrFail($orderId);
    }
}
