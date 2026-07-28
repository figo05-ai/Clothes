<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'name' => 'required|string',
            'base_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
            'slug' => 'required|string|unique:products,slug',
            'sku' => 'required|string|unique:products,sku',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
        ];
    }
}
