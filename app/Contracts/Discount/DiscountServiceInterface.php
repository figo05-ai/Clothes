<?php

namespace App\Contracts\Discount;

interface DiscountServiceInterface
{
    /**
     * Apply a coupon code to the current cart.
     *
     * @param string $code
     * @return array Array containing success status, message, and updated cart data
     */
    public function applyCoupon(string $code): array;

    /**
     * Remove the currently applied coupon from the cart.
     *
     * @return array Array containing success status and updated cart data
     */
    public function removeCoupon(): array;

    /**
     * Calculate the final cart total after discount.
     *
     * @param float $subtotal
     * @return float
     */
    public function calculateTotal(float $subtotal): float;
}
