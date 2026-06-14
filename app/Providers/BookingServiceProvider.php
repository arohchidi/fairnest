<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\BookingServiceInterface;

use App\Services\Admin\BookingService;


class BookingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
    }

    public function boot(): void
    {
        //
    }
}