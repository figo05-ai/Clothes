<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalItems = 0;
        $totalPrice = 0;

        $items = [];
        foreach ($this->resource as $item) {
            $items[] = [
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ];
            
            $totalItems += $item['quantity'];
            $totalPrice += ($item['price'] * $item['quantity']);
        }

        return [
            'success' => true,
            'data' => [
                'items' => $items,
                'summary' => [
                    'total_items' => $totalItems,
                    'total_price' => $totalPrice,
                ]
            ]
        ];
    }
}
