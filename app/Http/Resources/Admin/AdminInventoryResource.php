<?php
namespace App\Http\Resources\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class AdminInventoryResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'product_id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'current_stock' => $this->stock_quantity,
            'base_price' => $this->base_price,
            'category' => $this->category->name ?? null,
        ];
    }
}
