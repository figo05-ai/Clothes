<?php
namespace App\Services\Search;
use App\Contracts\Search\SearchServiceInterface;
use App\Models\Product;

class SearchService implements SearchServiceInterface {
    public function searchProducts(string $query) {
        return Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }
}
