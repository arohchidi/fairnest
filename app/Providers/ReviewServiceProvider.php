<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\ReviewServiceInterface;

use App\Services\ReviewService;


class ReviewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ReviewServiceInterface::class, ReviewService::class);
    }

    public function boot(): void
    {
        //
    }
}