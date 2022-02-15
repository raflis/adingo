<?php

namespace App\Providers;

use App\Models\Admin\Home;
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
    public function boot()
    {
        Paginator::useBootstrap();
        
        view()->composer('web.partials.footer',function($view){
            //$view->with('footer', Home::findOrFail(1));
        });
    }
}
