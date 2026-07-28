<?php
namespace App\Contracts\Return;

interface ReturnServiceInterface {
    public function createReturnRequest(string $orderId, array $data): array;
}
