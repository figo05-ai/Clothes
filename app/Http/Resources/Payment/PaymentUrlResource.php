<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentUrlResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'message' => 'Payment session created.',
            'data' => [
                'payment_url' => $this->resource
            ]
        ];
    }
}
