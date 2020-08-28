<?php

namespace App\Providers;

use App\Services\BiglandService\BiglandService;
use Illuminate\Support\ServiceProvider;

class BiglandServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BiglandService::class, function ($app) {
            return new BiglandService(\Config::get('services')['bigland']);
        });
/*
        $this->app->singleton('App\Services\BiglandService\BiglandServiceInterface', function ($app) {
            return new BiglandService(\Config::get('services')['bigland']);
        });
*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
