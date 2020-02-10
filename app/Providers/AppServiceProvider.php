<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Repositories\MetricRepository;
use App\Http\View\Composers\PaymentMethodsCompose;
use Illuminate\Support\Facades\View;

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
        View::composer(['partials.paymethods.*'], PaymentMethodsCompose::class);
    }
}
