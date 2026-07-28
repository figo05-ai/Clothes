<?php
namespace App\Services\Inventory;
use App\Contracts\Inventory\AdminInventoryServiceInterface;
use App\Models\Product;

class InventoryService implements AdminInventoryServiceInterface {
    public function getLowStockProducts(int $threshold = 10) {
        return Product::where('stock_quantity', '<=', $threshold)->orderBy('stock_quantity', 'asc')->get();
    }
    public function adjustStock(string $productId, int $quantity, string $reason) {
        $product = Product::findOrFail($productId);
        
        // In a real system, you might log the $reason to an `inventory_logs` table.
        // For now, we simply update the stock.
        $product->stock_quantity = $quantity;
        $product->save();
        
        return $product;
    }
}
