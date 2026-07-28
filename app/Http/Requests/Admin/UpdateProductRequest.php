<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'name' => 'sometimes|string',
            'base_price' => 'sometimes|numeric',
            'stock_quantity' => 'sometimes|integer',
            'category_id' => 'sometimes|exists:categories,id',
        ];
    }
}
