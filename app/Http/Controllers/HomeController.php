<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Services\Admin\PropertyService;
use Illuminate\View\View;

class HomeController extends Controller
{
    //
    protected $propertyService;

    public function __construct(PropertyService $propertyService){
        $this->propertyService = $propertyService;
    }

    public function index():View{
        $featured_properties = $this->propertyService->featuredProperties();

    
        
        $latestProperties = $this->propertyService->latestProperties();
        return view('front.home', compact('featured_properties','latestProperties'));
    }

    public function about():View{
        return view('front.about');
    }
}
