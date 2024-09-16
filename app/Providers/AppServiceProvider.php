<?php

namespace App\Providers;

use Illuminate\Support\{
    ServiceProvider,
    Facades\Auth,
};

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
        // Share the user role across all views if the user is authenticated
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userRole = Auth::user()->role;
                $view->with('userRole', $userRole);
            }
        });
    }
}
