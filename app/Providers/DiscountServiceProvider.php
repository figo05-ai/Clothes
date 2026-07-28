<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Discount\CouponManagementServiceInterface;
use App\Services\Discount\CouponManagementService;

class DiscountServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CouponManagementServiceInterface::class, CouponManagementService::class);
    }
}
