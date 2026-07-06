<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\ApartmentRequestServiceInterface;
use App\Services\Admin\ApartmentRequestService;

class ApartmentRequestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ApartmentRequestServiceInterface::class, ApartmentRequestService::class);
    }

    public function boot(): void
    {
        //
    }
}