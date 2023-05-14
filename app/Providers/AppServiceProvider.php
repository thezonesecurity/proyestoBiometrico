<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

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
        Carbon::setLocale(config('app.locale'));
    }

    public function boot()
    {
        //
        View::share('theme', 'layoutLTE');
    }

}
