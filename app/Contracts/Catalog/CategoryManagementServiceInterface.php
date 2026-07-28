<?php
namespace App\Contracts\Catalog;

interface CategoryManagementServiceInterface {
    public function getAllCategories();
    public function getCategoryDetails(string $id);
    public function createCategory(array $data);
    public function updateCategory(string $id, array $data);
    public function deleteCategory(string $id): void;
}
