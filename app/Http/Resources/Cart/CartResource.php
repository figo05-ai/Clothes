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

        $productIds = collect($this->resource)->pluck('id')->toArray();
        $products = \App\Models\Product::with(['images' => function($q) {
            $q->where('is_primary', true);
        }])->whereIn('id', $productIds)->get()->keyBy('id');

        $items = [];
        foreach ($this->resource as $item) {
            $product = $products->get($item['id']);
            $imageUrl = null;
            if ($product && $product->images->isNotEmpty()) {
                $imageUrl = asset($product->images->first()->image_path);
            } elseif ($product) {
                $imageUrl = "https://via.placeholder.com/800x1200?text=" . urlencode($product->name);
            }

            $items[] = [
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
                'image' => $imageUrl,
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
