<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // We allow guests to checkout for now
    }

    public function rules(): array
    {
        return [
            'shipping_address' => 'required|string|max:255',
            'billing_address' => 'nullable|string|max:255',
            'payment_method' => 'required|string|in:cash_on_delivery,credit_card,paypal,wallet',
            'shipping_cost' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
        ];
    }
}
