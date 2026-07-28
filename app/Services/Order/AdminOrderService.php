<?php
namespace App\Services\Order;

use App\Contracts\Order\AdminOrderServiceInterface;
use App\Models\Order;

class AdminOrderService implements AdminOrderServiceInterface {
    public function getAllOrders(int $perPage = 15) {
        return Order::with('user', 'items.product')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getOrderDetails(string $id) {
        return Order::with('user', 'items.product')->findOrFail($id);
    }

    public function updateOrderStatus(string $id, string $status) {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return $order;
    }
}
