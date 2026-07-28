<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'shipping_cost' => $this->shipping_cost,
            'grand_total' => $this->grand_total,
            'payment_method' => $this->payment_method,
            'shipping_address' => $this->shipping_address,
            'created_at' => $this->created_at->toDateTimeString(),
            'items' => $this->whenLoaded('items', function () {
                return $this->items->map(function ($item) {
                    return [
                        'product_name' => $item->product ? $item->product->name : 'Unknown Product',
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'subtotal' => $item->subtotal,
                    ];
                });
            }),
        ];
    }
}
