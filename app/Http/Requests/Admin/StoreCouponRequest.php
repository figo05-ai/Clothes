<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|in:percentage,fixed_amount',
            'value' => 'required|numeric',
            'usage_limit' => 'nullable|integer',
            'valid_until' => 'nullable|date',
        ];
    }
}
