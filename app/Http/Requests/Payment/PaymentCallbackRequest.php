<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentCallbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Webhooks are usually unauthenticated but verified via signature
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string',
            'data' => 'required|array',
            'data.object' => 'required|array',
            'data.object.id' => 'required|string',
        ];
    }
}
