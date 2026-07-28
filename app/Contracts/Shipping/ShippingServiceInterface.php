<?php
namespace App\Contracts\Shipping;
interface ShippingServiceInterface {
    public function trackShipment(string $trackingNumber);
}
