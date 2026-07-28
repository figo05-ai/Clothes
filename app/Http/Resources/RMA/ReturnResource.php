<?php
namespace App\Http\Resources\RMA;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class ReturnResource extends JsonResource {
    public function toArray(Request $request): array {
        return parent::toArray($request);
    }
}
