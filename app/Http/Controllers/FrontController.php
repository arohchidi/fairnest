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

      $title = "Faqs";
        return view('front.faqs', compact('title'));
    }

    public function terms():View{

      $title = "Terms and Conditions";
        return view('front.terms', compact('title'));
    }


    public function privacy():View{

      $title = "Privacy Policy";
        return view('front.faqs', compact('title'));
    }
}


