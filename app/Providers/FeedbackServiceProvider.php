<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\FeedbackServiceInterface;
use App\Services\FeedbackService;

class FeedbackServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FeedbackServiceInterface::class, FeedbackService::class);
    }

    public function boot(): void
    {
        //
    }
}