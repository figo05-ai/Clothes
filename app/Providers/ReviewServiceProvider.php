<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Review\ReviewServiceInterface;
use App\Contracts\Review\AdminReviewServiceInterface;
use App\Services\Review\ReviewService;

class ReviewServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(ReviewServiceInterface::class, ReviewService::class);
        $this->app->bind(AdminReviewServiceInterface::class, ReviewService::class);
    }
}
