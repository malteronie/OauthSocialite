<?php

namespace App\Providers;

use App\Services\CustomPassportProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

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
        Socialite::extend('passport', function ($app) {
            $config = $app['config']['services.passport'];
            return Socialite::buildProvider(CustomPassportProvider::class, $config);
        });
        
    }
}
