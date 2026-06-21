<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Admin\AdminBookingService;

class AdminBookingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdminBookingService::class, AdminBookingService::class);
    }

    public function boot(): void
    {
        //
    }
}