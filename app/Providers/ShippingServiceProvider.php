<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Shipping\ShippingServiceInterface;
use App\Contracts\Shipping\AdminShippingServiceInterface;
use App\Services\Shipping\ShippingService;

class ShippingServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(ShippingServiceInterface::class, ShippingService::class);
        $this->app->bind(AdminShippingServiceInterface::class, ShippingService::class);
    }
}
