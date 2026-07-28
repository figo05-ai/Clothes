<?php

namespace App\Contracts\Shipping;

interface ShippingGatewayInterface
{
    /**
     * Create a shipment and return tracking information.
     *
     * @param array $orderDetails
     * @return array
     */
    public function createShipment(array $orderDetails): array;

    /**
     * Track a shipment by its tracking number.
     *
     * @param string $trackingNumber
     * @return array
     */
    public function trackShipment(string $trackingNumber): array;
}
