<?php
namespace App\Services\Product;

use App\Contracts\Product\ProductManagementServiceInterface;
use App\Models\Product;

class ProductManagementService implements ProductManagementServiceInterface {
    public function getAllProducts(int $perPage = 15) {
        return Product::with('subcategory')->paginate($perPage);
    }
    public function createProduct(array $data) {
        return Product::create($data);
    }
    public function updateProduct(string $id, array $data) {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
    public function deleteProduct(string $id): void {
        Product::findOrFail($id)->delete();
    }
}
