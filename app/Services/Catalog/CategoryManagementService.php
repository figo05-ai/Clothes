<?php
namespace App\Services\Catalog;

use App\Contracts\Catalog\CategoryManagementServiceInterface;
use App\Models\Category;

class CategoryManagementService implements CategoryManagementServiceInterface {
    public function getAllCategories() {
        return Category::with('subcategories')->get();
    }
    public function getCategoryDetails(string $id) {
        return Category::with('subcategories', 'products')->findOrFail($id);
    }
    public function createCategory(array $data) {
        return Category::create($data);
    }
    public function updateCategory(string $id, array $data) {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }
    public function deleteCategory(string $id): void {
        Category::findOrFail($id)->delete();
    }
}
