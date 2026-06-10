<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreatePropertyRequest;
use App\Http\Requests\Admin\UpdatePropertyRequest;
use App\Contracts\Services\PropertyServiceInterface;
use App\Services\Admin\PropertyService;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use Illuminate\View\View;

use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;



class PropertyController extends Controller
{
    //
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }



    
    public function index(Request $request): View
    {
      

        $filters = $request->only(['search', 'status', 'type_of_house', 'rent_fee', 'sort_by', 'sort_order', 'per_page']);
        
        $properties = $this->propertyService->getFilteredProperties($filters);

       
        return view('admin.properties.index', compact('properties'));
    }

    public function create(){
        return view('admin.properties.create');
    }

    public function store(CreatePropertyRequest $request){


        try {
            
            $property = $this->propertyService->createProperty($request->all());
            Log::info('Property created successfully', ['property_id' => $property->id]);
            return redirect()->route('admin.properties.index')
                ->with('success', 'Property created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create property', ['error' => $e->getMessage()]);
            return back()
                ->withInput($request->except('images')) // Don't retain images on error
                ->with('error', 'Failed to create property: ' . $e->getMessage());
        }

    }


    public function showPropertyById($id):View{
     $id = $id;
     $property = $this->propertyService->getPropertyById($id);
    
    return view('admin.properties.show', compact('property'));
    }


    public function edit($id):View{
    $id = $id;
    $property = $this->propertyService->getPropertyById($id);
    
    return view('admin.properties.edit', compact('property'));
    }


    public function updateProperty(UpdatePropertyRequest $request , int $id):HttpFoundationRedirectResponse{


   

    try{

    $property = $this->propertyService->updateProperty($id, $request->all());

    return redirect()->route('admin.properties.index')->with('success', 'Property'.$property->title . 'has been edited successfully');

    } catch(\Exception $e){
         return back()
                ->withInput()
                ->with('error', 'Failed to update property: ' . $e->getMessage());
    }

    }


    public function deleteProperty($id):HttpFoundationRedirectResponse{
    $property = $this->propertyService->deleteProperty($id);
    try{

    return redirect()->route('admin.properties.index')->with('success', 'Property has been deleted');
    } catch(\Exception $e){
         return back()
                ->withInput()
                ->with('error', 'Failed to update property: ' . $e->getMessage());
    }
    }
}
