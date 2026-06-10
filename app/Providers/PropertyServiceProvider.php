<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\PropertyServiceInterface;
use App\Services\Admin\PropertyService;

class PropertyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PropertyServiceInterface::class, PropertyService::class);
    }

    public function boot(): void
    {
        //
    }
}