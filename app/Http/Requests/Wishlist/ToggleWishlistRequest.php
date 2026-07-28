<?php
namespace App\Http\Requests\Wishlist;
use Illuminate\Foundation\Http\FormRequest;

class ToggleWishlistRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'product_id' => 'required|exists:products,id',
        ];
    }
}
