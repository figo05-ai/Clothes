<?php

namespace App\Contracts\Product;

interface ProductFilterServiceInterface
{
    /**
     * Get paginated products based on applied filters.
     *
     * @param array $filters The filter criteria (category, subcategory, size, color, min_price, max_price, search)
     * @param int $perPage The number of items per page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFilteredProducts(array $filters, int $perPage = 15);
}
