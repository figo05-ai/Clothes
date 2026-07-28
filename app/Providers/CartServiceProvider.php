<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Cart\CartServiceInterface;
use App\Services\Cart\CartService;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, CartService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
