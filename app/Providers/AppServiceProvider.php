<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('app/Http/helpers.php');

        $admin = request()->segment(1);

        if ($admin != 'admin') {

            View::share('menu', getFrontEndMenu());
            View::share('lang', getActiveLanguages());
            View::share('rooms',getRooms());
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
