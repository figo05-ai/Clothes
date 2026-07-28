<?php

namespace App\Contracts\Cart;

interface CartServiceInterface
{
    /**
     * Add a product to the cart.
     *
     * @param string $productId
     * @param int $quantity
     * @return array
     */
    public function add(string $productId, int $quantity): array;

    /**
     * Remove a product from the cart.
     *
     * @param string $productId
     * @return array
     */
    public function remove(string $productId): array;

    /**
     * Get the current cart contents.
     *
     * @return array
     */
    public function getCart(): array;

    /**
     * Clear the entire cart.
     *
     * @return void
     */
    public function clear(): void;
}
