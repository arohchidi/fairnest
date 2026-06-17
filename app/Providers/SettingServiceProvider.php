<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\SettingServiceInterface;

use App\Services\Admin\SettingService;


class SettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
    }

    public function boot(): void
    {
        //
    }
}