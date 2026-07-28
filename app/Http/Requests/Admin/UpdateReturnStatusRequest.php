<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateReturnStatusRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'status' => 'required|in:pending,approved,rejected,completed',
        ];
    }
}
