<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class StoreBannerRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'title' => 'required|string|max:255',
            'image_url' => 'required|url',
            'link_url' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
