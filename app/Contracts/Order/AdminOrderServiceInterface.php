<?php
namespace App\Contracts\Order;

interface AdminOrderServiceInterface {
    public function getAllOrders(int $perPage = 15);
    public function getOrderDetails(string $id);
    public function updateOrderStatus(string $id, string $status);
}
