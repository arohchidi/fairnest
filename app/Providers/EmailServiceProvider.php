<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\EmailServiceInterface;
use App\Services\Admin\EmailService;

class EmailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmailServiceInterface::class, EmailService::class);
    }

    public function boot(): void
    {
        //
    }
}