<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    //

public function index()
{
    $title = "Contact Us Page";
    return view('front.contact', compact('title'));
}


public function store(){
    
}

}

