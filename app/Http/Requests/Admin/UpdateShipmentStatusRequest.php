<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateShipmentStatusRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'status' => 'required|in:pending,shipped,in_transit,delivered,failed',
        ];
    }
}
