<?php
namespace App\Services\Return;
use App\Contracts\Return\ReturnServiceInterface;

class ReturnService implements ReturnServiceInterface {
    public function createReturnRequest(string $orderId, array $data): array {
        return ['success' => true, 'message' => 'Return request created.'];
    }
}
