<?php
namespace App\Contracts\Inventory;
interface AdminInventoryServiceInterface {
    public function getLowStockProducts(int $threshold = 10);
    public function adjustStock(string $productId, int $quantity, string $reason);
}
