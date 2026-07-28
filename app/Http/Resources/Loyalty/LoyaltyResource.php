<?php
namespace App\Http\Resources\Loyalty;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class LoyaltyResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'points' => $this->resource, // Direct integer mapping
        ];
    }
}
