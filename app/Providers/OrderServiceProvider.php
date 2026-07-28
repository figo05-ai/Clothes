<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Order\OrderServiceInterface;
use App\Services\Order\OrderService;
use App\Contracts\Order\AdminOrderServiceInterface;
use App\Services\Order\AdminOrderService;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(AdminOrderServiceInterface::class, AdminOrderService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
