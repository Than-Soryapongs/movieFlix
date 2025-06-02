<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share filter dropdown data with all views
        View::composer('*', function ($view) {
            $view->with('actors', Actor::orderBy('name')->get());
            $view->with('directors', Director::orderBy('name')->get());
            $view->with('genres', Genre::orderBy('name')->get());
        });
    }
}
