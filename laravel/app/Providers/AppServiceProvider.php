<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force relative URLs for redirects in GitHub Codespaces
        if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) || request()->header('X-Forwarded-Host')) {
            URL::forceScheme('https');
        }
    }
}