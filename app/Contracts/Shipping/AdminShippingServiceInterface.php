<?php
namespace App\Contracts\Shipping;
interface AdminShippingServiceInterface {
    public function createShipment(string $orderId, array $data);
    public function updateShipmentStatus(string $trackingNumber, string $status);
}
