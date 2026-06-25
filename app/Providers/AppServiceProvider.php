<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\DoaServiceInterface;
use App\Services\DoaService;
use App\Contracts\FavoriteServiceInterface;
use App\Services\FavoriteService;
use App\Contracts\MemorizationServiceInterface;
use App\Services\MemorizationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DoaServiceInterface::class, DoaService::class);
        $this->app->bind(FavoriteServiceInterface::class, FavoriteService::class);
        $this->app->bind(MemorizationServiceInterface::class, MemorizationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
