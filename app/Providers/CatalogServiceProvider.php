<?php

namespace App\Providers;

use App\Contracts\Catalog\CategoryManagementServiceInterface;
use App\Services\Catalog\CategoryManagementService;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Product\ProductFilterServiceInterface;
use App\Services\Product\ProductFilterService;
use App\Contracts\Product\ProductManagementServiceInterface;
use App\Services\Product\ProductManagementService;

class CatalogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryManagementServiceInterface::class, CategoryManagementService::class);
        $this->app->bind(ProductFilterServiceInterface::class, ProductFilterService::class);
        $this->app->bind(ProductManagementServiceInterface::class, ProductManagementService::class);
    }
}
