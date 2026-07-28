<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\RMA\ReturnServiceInterface;
use App\Contracts\RMA\AdminReturnServiceInterface;
use App\Services\RMA\ReturnService;

class ReturnServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(ReturnServiceInterface::class, ReturnService::class);
        $this->app->bind(AdminReturnServiceInterface::class, ReturnService::class);
    }
}
