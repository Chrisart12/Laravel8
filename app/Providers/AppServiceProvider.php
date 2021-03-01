<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\PaysInterface', 'App\Repositories\PaysRepository');
        $this->app->bind('App\Repositories\UserInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\ImageInterface', 'App\Repositories\ImageRepository');

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
