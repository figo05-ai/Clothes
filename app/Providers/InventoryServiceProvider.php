<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Inventory\AdminInventoryServiceInterface;
use App\Services\Inventory\InventoryService;

class InventoryServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(AdminInventoryServiceInterface::class, InventoryService::class);
    }
}
