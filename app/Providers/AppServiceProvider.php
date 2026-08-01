<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                $view->with('categories', \App\Models\Category::all());
            }
            if (auth()->check()) {
                $view->with('wishlistProductIds', auth()->user()->wishlist()->pluck('product_id')->toArray());
            } else {
                $view->with('wishlistProductIds', []);
            }
        });
    }
}
