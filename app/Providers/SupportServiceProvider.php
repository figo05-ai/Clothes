<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Support\SupportServiceInterface;
use App\Contracts\Support\AdminSupportServiceInterface;
use App\Services\Support\SupportService;

class SupportServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(SupportServiceInterface::class, SupportService::class);
        $this->app->bind(AdminSupportServiceInterface::class, SupportService::class);
    }
}
