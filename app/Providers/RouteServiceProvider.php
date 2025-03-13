<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapConsoleRoutes();
    }

    // Optionally map API routes
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'throttle:60,1'])
            ->group(base_path('routes/api.php'));
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
