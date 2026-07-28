<?php
namespace App\Http\Resources\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class ShipmentResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'tracking_number' => $this->tracking_number,
            'carrier' => $this->carrier,
            'status' => $this->status,
            'shipped_at' => $this->shipped_at,
            'delivered_at' => $this->delivered_at,
            'order_id' => $this->order_id,
        ];
    }
}
