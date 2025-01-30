<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapConsoleRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    // Optionally map API routes
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
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
