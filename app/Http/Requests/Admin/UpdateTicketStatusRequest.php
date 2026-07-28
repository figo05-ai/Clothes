<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateTicketStatusRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'status' => 'required|in:open,in_progress,resolved,closed',
        ];
    }
}
