<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
        ];
    }
}
