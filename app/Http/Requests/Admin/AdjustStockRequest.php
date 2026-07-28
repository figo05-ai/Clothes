<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class AdjustStockRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'quantity' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ];
    }
}
