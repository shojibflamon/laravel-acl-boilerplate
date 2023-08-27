<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        $themeConfig = config('theme');
        
        $defaultTheme = $themeConfig['defaultTheme'];
        
        $themeLayout = $themeConfig['themes'][$defaultTheme]['layout'];
        
        app()->instance('themeLayout', $themeLayout);
        
        View::share(['themeLayout' => $themeLayout]);
    }
}
