<?php
namespace App\Contracts\RMA;
interface AdminReturnServiceInterface {
    public function getAllReturns();
    public function updateReturnStatus(string $returnId, string $status);
}
