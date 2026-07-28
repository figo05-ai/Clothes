<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Content\ContentServiceInterface;
use App\Contracts\Content\AdminContentServiceInterface;
use App\Services\Content\ContentService;

class ContentServiceProvider extends ServiceProvider {
    public function register(): void {
        $this->app->bind(ContentServiceInterface::class, ContentService::class);
        $this->app->bind(AdminContentServiceInterface::class, ContentService::class);
    }
}
