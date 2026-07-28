<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Media\MediaServiceInterface;
use App\Services\Media\MediaService;
class MediaServiceProvider extends ServiceProvider { public function register(): void { $this->app->bind(MediaServiceInterface::class, MediaService::class); } }