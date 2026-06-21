<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Http\Request;

use App\Services\Admin\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class SettingController extends Controller
{
    //

    protected $settingService;

    public function __construct(SettingService $settingService){
        $this->settingService =  $settingService;
    }


    public function index():View
    {
       
       $settings = $this->settingService->settings();
       return view('admin.settings.index',compact('settings'));
       
    }

    public function store(SettingRequest $request):RedirectResponse
    {

    try{
       $setting = $this->settingService->store($request->validated());
      

       return redirect()->back()->with('success',ucwords($request['tab']).' Settings have been Updated');
    } catch(\Exception $e){
        Log::error($e->getMessage());
          return redirect()->back()->with('error','Whoops,something went wrong');
    }

    }

    public function terms():View
    {
       $settings = $this->settingService->settings();
       return view('admin.pages.terms',compact('settings'));
       
    }

     public function privacyPolicy():View
    {
       $settings = $this->settingService->settings();
       return view('admin.pages.privacy-policy',compact('settings'));
       
    }
    
}
