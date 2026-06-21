<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\AdminReviewServiceInterface;
use App\Services\Admin\AdminReviewService;

class AdminReviewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdminReviewServiceInterface::class, AdminReviewService::class);
    }

    public function boot(): void
    {
        //
    }
}