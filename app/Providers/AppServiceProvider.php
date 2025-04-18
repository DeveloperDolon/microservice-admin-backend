<?php

namespace App\Providers;

use App\Jobs\VariantUpdateJob;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        App::bindMethod(VariantUpdateJob::class, '@handle', fn($variant) => $variant->handle());
    }
}
;