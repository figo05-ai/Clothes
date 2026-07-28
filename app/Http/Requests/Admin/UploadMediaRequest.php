<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UploadMediaRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'path' => 'nullable|string'
        ];
    }
}
