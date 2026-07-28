<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateCategoryRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255',
            'icon' => 'nullable|string'
        ];
    }
}
