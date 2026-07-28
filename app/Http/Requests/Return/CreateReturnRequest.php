<?php
namespace App\Http\Requests\Return;
use Illuminate\Foundation\Http\FormRequest;

class CreateReturnRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array { return ['reason' => 'required|string']; }
}
