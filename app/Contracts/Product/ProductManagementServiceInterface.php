<?php
namespace App\Contracts\Product;

interface ProductManagementServiceInterface {
    public function getAllProducts(int $perPage = 15);
    public function createProduct(array $data);
    public function updateProduct(string $id, array $data);
    public function deleteProduct(string $id): void;
}
