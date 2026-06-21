<?php

namespace App\Http\Controllers;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontController extends Controller
{
    //



    public function faqs():View{
     
     $categories = Faq::select('category')
    ->distinct()
    ->orderByRaw("
        FIELD(
            category,
            'General',
            'Booking',
            'Property',
            'Payments',
            'Support',
            'Cancellation'
        )
    ")
    ->pluck('category');
      $faqs = Faq::where('is_active',1)->orderby('sort_id','asc')->get()->groupBy('category');
     
      $title = "Faqs";
        return view('front.faqs', compact('title','categories', 'faqs'));
    }

    public function terms():View{

      $data = Setting::first();
      $title = "Terms and Conditions";
        return view('front.terms', compact('title', 'data'));
    }


    public function privacy():View{
        $data = Setting::first();
      $title = "Privacy Policy";
        return view('front.privacy-policy', compact('title','data' ));
    }
}


