<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Wishlist\WishlistServiceInterface;
use App\Services\Wishlist\WishlistService;

class WishlistServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(WishlistServiceInterface::class, WishlistService::class);
    }
}
