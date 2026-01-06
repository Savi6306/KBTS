<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {

            /**
             * USER ROUTES
             * File: routes/web.php
             */
            Route::middleware('web')
                ->group(base_path('routes/web.php'));


            /**
             * AGENT ROUTES
             * File: routes/agent.php
             */
            Route::middleware('web')
                ->group(base_path('routes/agent.php'));


            /**
             * ADMIN ROUTES
             * File: routes/admin.php
             */
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        });
    }
}
