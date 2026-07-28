<?php
namespace App\Services\Shipping;
use App\Contracts\Shipping\ShippingServiceInterface;
use App\Contracts\Shipping\AdminShippingServiceInterface;
use App\Models\Shipment;
use App\Models\Order;

class ShippingService implements ShippingServiceInterface, AdminShippingServiceInterface {
    public function trackShipment(string $trackingNumber) {
        return Shipment::with('order.user')->where('tracking_number', $trackingNumber)->firstOrFail();
    }
    public function createShipment(string $orderId, array $data) {
        $order = Order::findOrFail($orderId);
        return Shipment::create([
            'order_id' => $order->id,
            'tracking_number' => $data['tracking_number'],
            'carrier' => $data['carrier'],
            'status' => 'shipped',
            'shipped_at' => now(),
        ]);
    }
    public function updateShipmentStatus(string $trackingNumber, string $status) {
        $shipment = Shipment::where('tracking_number', $trackingNumber)->firstOrFail();
        $shipment->status = $status;
        if ($status === 'delivered') $shipment->delivered_at = now();
        $shipment->save();
        return $shipment;
    }
}
