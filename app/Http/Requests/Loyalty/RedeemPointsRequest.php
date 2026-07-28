<?php
namespace App\Http\Requests\Loyalty;
use Illuminate\Foundation\Http\FormRequest;
class RedeemPointsRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'points' => 'required|integer|min:100',
        ];
    }
}
