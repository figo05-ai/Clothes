<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class StorePageRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ];
    }
}
