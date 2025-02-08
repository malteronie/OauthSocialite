<?php

namespace App\Providers;

use App\Services\CustomPassportProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Facades\Socialite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    //     $socialite = $this->app->make(Factory::class);
 
    //     $socialite->extend('oauth', function () use ($socialite) {
    //         $config = config('services.oauth');
     
    //         return $socialite->buildProvider(SocialiteOauthProvider::class, $config);
    //     });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    
    Socialite::extend('passport', function ($app) {
        $config = $app['config']['services.passport'];
        return Socialite::buildProvider(CustomPassportProvider::class, $config);
    });
}
}





