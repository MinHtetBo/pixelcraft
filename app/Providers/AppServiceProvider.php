<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     Paginator::useBootstrap();
    // }
    public function boot()
{
    if (config('app.env') === 'production' || env('APP_URL') !== 'http://localhost') {
        URL::forceScheme('https');
    }
}
}
