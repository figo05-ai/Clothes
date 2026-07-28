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
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->base_price,
                    'subtotal' => $subtotal,
                ];

                // Deduct stock
                $product->stock_quantity -= $item['quantity'];
                $product->save();
            }

            // 2. Create the Order
            $order = Order::create([
                'user_id' => $userId, // Can be null for guest checkout
                'total_amount' => $totalAmount,
                'shipping_cost' => $checkoutData['shipping_cost'] ?? 0,
                'tax_amount' => $checkoutData['tax_amount'] ?? 0,
                'grand_total' => $totalAmount + ($checkoutData['shipping_cost'] ?? 0) + ($checkoutData['tax_amount'] ?? 0),
                'status' => 'pending',
                'shipping_address' => $checkoutData['shipping_address'] ?? 'Pending',
                'billing_address' => $checkoutData['billing_address'] ?? 'Pending',
                'payment_method' => $checkoutData['payment_method'] ?? 'cash_on_delivery',
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
