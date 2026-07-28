<?php

namespace App\Services\Shipping;

use App\Contracts\Shipping\ShippingGatewayInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DummyShippingService implements ShippingGatewayInterface
{
    public function createShipment(array $orderDetails): array
    {
        $trackingNumber = 'TRK-' . strtoupper(Str::random(10));
        
        Log::info("Shipment created for Order ID: {$orderDetails['order_id']} with tracking number: {$trackingNumber}");

        return [
            'success' => true,
            'tracking_number' => $trackingNumber,
            'courier' => 'Aramex Dummy',
            'status' => 'Pending Pickup'
        ];
    }

    public function trackShipment(string $trackingNumber): array
    {
        // Mock tracking response
        return [
            'success' => true,
            'tracking_number' => $trackingNumber,
            'status' => 'In Transit',
            'expected_delivery' => now()->addDays(3)->toDateString(),
            'history' => [
                ['status' => 'Pending Pickup', 'timestamp' => now()->subDay()->toDateTimeString()],
                ['status' => 'In Transit', 'timestamp' => now()->toDateTimeString()],
            ]
        ];
    }
}
