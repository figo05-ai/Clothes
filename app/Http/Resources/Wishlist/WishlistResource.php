<?php
namespace App\Http\Resources\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id ?? null,
                'name' => $this->product->name ?? null,
                'price' => $this->product->base_price ?? null,
            ],
            'added_at' => $this->created_at,
        ];
    }
}
