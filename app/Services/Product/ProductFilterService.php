<?php

namespace App\Services\Product;

use App\Contracts\Product\ProductFilterServiceInterface;
use App\Models\Product;

class ProductFilterService implements ProductFilterServiceInterface
{
    /**
     * Get paginated products based on applied filters.
     */
    public function getFilteredProducts(array $filters, int $perPage = 15)
    {
        $query = Product::query();

        // Include relations to avoid N+1 query problems
        $query->with(['subcategory']);

        // Search by name or description
        if (!empty($filters['search'])) {
            $searchTerm = '%' . $filters['search'] . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                  ->orWhere('description', 'LIKE', $searchTerm);
            });
        }

        // Filter by Category
        if (!empty($filters['category_id'])) {
            $query->whereHas('subcategory', function($q) use ($filters) { $q->where('category_id', $filters['category_id']); });
        }

        // Filter by Subcategory
        if (!empty($filters['subcategory_id'])) {
            $query->where('subcategory_id', $filters['subcategory_id']);
        }

        // Filter by Colors (assuming colors is a JSON column or related table)
        // For now, assume it's a simple JSON field based on our schema
        if (!empty($filters['color'])) {
            $query->whereJsonContains('colors', $filters['color']);
        }

        // Filter by Sizes (assuming sizes is a JSON column)
        if (!empty($filters['size'])) {
            $query->whereJsonContains('sizes', $filters['size']);
        }

        // Filter by Minimum Price
        if (isset($filters['min_price'])) {
            $query->where('base_price', '>=', $filters['min_price']);
        }

        // Filter by Maximum Price
        if (isset($filters['max_price'])) {
            $query->where('base_price', '<=', $filters['max_price']);
        }

        // Sort results
        if (!empty($filters['sort_by'])) {
            $direction = $filters['sort_direction'] ?? 'asc';
            // Allow only certain columns for sorting to prevent SQL injection
            $allowedSorts = ['base_price', 'created_at', 'name'];
            if (in_array($filters['sort_by'], $allowedSorts)) {
                $query->orderBy($filters['sort_by'], $direction);
            }
        } else {
            // Default sort
            $query->orderBy('created_at', 'desc');
        }

        // Return Paginated result
        return $query->paginate($perPage);
    }
}
