<?php
namespace App\Http\Resources\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class WalletTransactionResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => (float) $this->amount,
            'description' => $this->description,
            'date' => $this->created_at,
        ];
    }
}
