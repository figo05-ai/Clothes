<?php
namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminOrderResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'email' => $this->user->email ?? null,
            ],
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at,
            'items' => $this->items, // Can map to AdminOrderItemResource if needed
        ];
    }
}
