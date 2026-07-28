<?php
namespace App\Contracts\RMA;
interface ReturnServiceInterface {
    public function getUserReturns(string $userId);
    public function createReturn(string $userId, array $data);
}
