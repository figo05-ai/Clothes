<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Search\SearchServiceInterface;
use App\Services\Search\SearchService;
class SearchServiceProvider extends ServiceProvider { public function register(): void { $this->app->bind(SearchServiceInterface::class, SearchService::class); } }