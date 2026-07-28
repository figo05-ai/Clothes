<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:100',
            'category_id' => 'nullable|string|exists:categories,id',
            'subcategory_id' => 'nullable|string|exists:subcategories,id',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:20',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
            'sort_by' => 'nullable|string|in:base_price,created_at,name',
            'sort_direction' => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }
}
