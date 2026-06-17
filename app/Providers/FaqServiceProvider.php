<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\FaqServiceInterface;

use App\Services\Admin\FaqService;


class FaqServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FaqServiceInterface::class, FaqService::class);
    }

    public function boot(): void
    {
        //
    }
}