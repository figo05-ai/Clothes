<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Analytics\AnalyticsServiceInterface;
use App\Services\Analytics\AnalyticsService;
class AnalyticsServiceProvider extends ServiceProvider { public function register(): void { $this->app->bind(AnalyticsServiceInterface::class, AnalyticsService::class); } }