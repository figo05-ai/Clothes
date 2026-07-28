<?php
namespace App\Http\Requests\Review;
use Illuminate\Foundation\Http\FormRequest;
class AddReviewRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ];
    }
}
