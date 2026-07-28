<?php
namespace App\Http\Requests\RMA;
use Illuminate\Foundation\Http\FormRequest;
class CreateReturnRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required|string|max:255',
            'details' => 'nullable|string',
        ];
    }
}
