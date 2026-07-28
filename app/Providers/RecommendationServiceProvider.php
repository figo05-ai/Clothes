<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Recommendation\RecommendationServiceInterface;
use App\Services\Recommendation\RecommendationService;
class RecommendationServiceProvider extends ServiceProvider { public function register(): void { $this->app->bind(RecommendationServiceInterface::class, RecommendationService::class); } }