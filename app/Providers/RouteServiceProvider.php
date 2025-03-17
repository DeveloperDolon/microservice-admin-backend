<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }


    public function map()
    {
        $this->mapApiRoutes();
        $this->mapConsoleRoutes();
    }

    // Optionally map API routes
    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware(['throttle:60,1'])
            ->group(function () {
                require base_path('routes/api.php');
                require base_path('routes/auth.php');
            });
    }

    // Optionally map console routes
    protected function mapConsoleRoutes()
    {
        Route::group([
            'prefix' => 'console',
        ], function () {
            require base_path('routes/console.php');
        });
    }
}
