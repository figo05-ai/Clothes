<?php
namespace App\Http\Resources\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class ReviewResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'user' => $this->user->name ?? 'Anonymous',
            'rating' => $this->rating,
            'review_text' => $this->review_text,
            'date' => $this->created_at,
        ];
    }
}
