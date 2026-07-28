<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Wallet\WalletServiceInterface;
use App\Contracts\Wallet\AdminWalletServiceInterface;
use App\Services\Wallet\WalletService;

class WalletServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(WalletServiceInterface::class, WalletService::class);
        $this->app->bind(AdminWalletServiceInterface::class, WalletService::class);
    }
}
