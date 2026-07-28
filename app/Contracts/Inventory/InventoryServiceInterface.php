<?php
namespace App\Contracts\Inventory;

interface InventoryServiceInterface {
    public function checkStock(string $productId, int $quantity): bool;
}
