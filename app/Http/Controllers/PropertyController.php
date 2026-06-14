<?php

namespace App\Http\Controllers;
use App\Services\Admin\PropertyService;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{

    protected $propertyService;

     public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }



    public function properties(Request $request):View
    {
         $filters = $request->only(['search', 'status', 'type_of_house', 'rent_fee', 'sort_by', 'sort_order', 'per_page']);
        
        $properties = $this->propertyService->getFilteredProperties($filters);
        $title = "Display Property listings";
    
    return view('front.property-listings', compact('properties', 'title'));
    }

    public function propertyDetails(int $id)
    { 
        try{
    
    $data = $this->propertyService->getPropertyById($id);

     $property = $data['property'];
     $similarProperties = $data['similarProperties'];

     $title = "Property details for ".$property->title;
    return view('front.property-details', compact('property', 'similarProperties','title'));
        } catch (\Exception $e){
return back()->with('error', $e->getMessage());
        }

    }

}
