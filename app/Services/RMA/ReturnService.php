<?php
namespace App\Services\RMA;
use App\Contracts\RMA\ReturnServiceInterface;
use App\Contracts\RMA\AdminReturnServiceInterface;
use App\Models\ReturnRequest as RMARequest;

class ReturnService implements ReturnServiceInterface, AdminReturnServiceInterface {
    public function getUserReturns(string $userId) {
        return RMARequest::with('order')->where('user_id', $userId)->get();
    }
    public function createReturn(string $userId, array $data) {
        return RMARequest::create([
            'user_id' => $userId,
            'order_id' => $data['order_id'],
            'reason' => $data['reason'],
            'details' => $data['details'] ?? null,
            'status' => 'pending'
        ]);
    }
    public function getAllReturns() {
        return RMARequest::with('order', 'user')->orderBy('created_at', 'desc')->get();
    }
    public function updateReturnStatus(string $returnId, string $status) {
        $returnReq = RMARequest::findOrFail($returnId);
        $returnReq->status = $status;
        $returnReq->save();
        return $returnReq;
    }
}
