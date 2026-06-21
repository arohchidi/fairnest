<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\GlobalComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

   
        View::composer(
            '*',
            GlobalComposer::class
        );
    }
}