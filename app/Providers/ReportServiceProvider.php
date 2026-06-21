<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\ReportServiceInterface;

use App\Services\ReportService;


class ReportServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ReportServiceInterface::class, ReportService::class);
    }

    public function boot(): void
    {
        //
    }
}