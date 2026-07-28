<?php
namespace App\Http\Requests\Support;
use Illuminate\Foundation\Http\FormRequest;
class ReplyTicketRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'message' => 'required|string',
        ];
    }
}
