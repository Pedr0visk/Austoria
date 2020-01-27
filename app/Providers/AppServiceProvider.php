<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Repositories\MetricRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MetricRpository::class, function ($app) {

            return new MetricRepository();
        });
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
