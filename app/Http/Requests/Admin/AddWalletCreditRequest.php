<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class AddWalletCreditRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string',
        ];
    }
}
