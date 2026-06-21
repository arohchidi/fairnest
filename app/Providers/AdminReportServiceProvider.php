<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\AdminReportServiceInterface;
use App\Services\Admin\AdminReportService;

class AdminReportServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdminReportServiceInterface::class, AdminReportService::class);
    }

    public function boot(): void
    {
        //
    }
}