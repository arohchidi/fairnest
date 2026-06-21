<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;



class GlobalComposer
{
    public function compose(View $view)
    {
       $settings = Cache::rememberForever('site_settings', function () {
    return Setting::first()?->toArray();
});

$view->with('settings', $settings);
    }
}