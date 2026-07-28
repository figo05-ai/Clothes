<?php

namespace App\Contracts\Order;

interface OrderServiceInterface
{
    /**
     * Process checkout and create an order from the user's cart.
     *
     * @param array $checkoutData Data related to shipping and payment.
     * @param string|null $userId User ID if authenticated.
     * @return mixed
     * @throws \Exception
     */
    public function checkout(array $checkoutData, ?string $userId = null);

    /**
     * Get details of a specific order.
     *
     * @param string $orderId
     * @return mixed
     */
    public function getOrderDetails(string $orderId);
}
