<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Loyalty\LoyaltyServiceInterface;
use App\Services\Loyalty\LoyaltyPointsService;

class LoyaltyServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(LoyaltyServiceInterface::class, LoyaltyPointsService::class);
    }
    public function boot(): void {}
}
