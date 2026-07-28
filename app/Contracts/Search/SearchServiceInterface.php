<?php
namespace App\Contracts\Search;
interface SearchServiceInterface {
    public function searchProducts(string $query);
}
