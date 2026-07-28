<?php
namespace App\Http\Requests\Support;
use Illuminate\Foundation\Http\FormRequest;
class CreateTicketRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }
}
