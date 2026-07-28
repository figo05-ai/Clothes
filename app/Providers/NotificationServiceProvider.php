<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Notification\NotificationServiceInterface;
use App\Services\Notification\NotificationService;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
