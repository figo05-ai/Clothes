<?php

namespace App\Services\Cart;

use App\Contracts\Cart\CartServiceInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService implements CartServiceInterface
{
    /**
     * Get or create a cart for the current user/session.
     */
    protected function resolveCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        $sessionId = Session::getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    /**
     * Add a product to the cart.
     */
    public function add(string $productId, int $quantity): array
    {
        $product = Product::findOrFail($productId);
        $cart = $this->resolveCart();

        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->base_price,
            ]);
        }

        return $this->getCart();
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(string $productId): array
    {
        $cart = $this->resolveCart();
        $cart->items()->where('product_id', $productId)->delete();

        return $this->getCart();
    }

    /**
     * Get the current cart contents.
     */
    public function getCart(): array
    {
        $cart = $this->resolveCart();
        $items = $cart->items()->with('product')->get();

        $formattedCart = [];
        foreach ($items as $item) {
            $formattedCart[$item->product_id] = [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'image' => null, // Add logic to get image if needed
            ];
        }

        return $formattedCart;
    }

    /**
     * Clear the entire cart.
     */
    public function clear(): void
    {
        $cart = $this->resolveCart();
        $cart->items()->delete();
    }
}
