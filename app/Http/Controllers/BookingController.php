<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\Admin\PropertyService;
use App\Services\BookingService;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;




class BookingController extends Controller
{
    //
    protected $propertyService;
    protected $bookingService;

    public function __construct(PropertyService $propertyService, BookingService $bookingService){
        $this->propertyService = $propertyService;
        $this->bookingService = $bookingService;
    }


    public function index($id):View

    {
        $data = $this->propertyService->getPropertyById($id);

        $property = $data['property'];
        $title =  "Booking inspection for ".$property->title;

        

        return view('booking.property-inspection', compact('property', 'title'));
    }

    public function storeBooking(BookingRequest $request):HttpFoundationRedirectResponse
    {

      try{

      $booking = $this->bookingService->storeBooking($request->all());

 


      $request->session()->put('last_booking', $booking);

       return redirect()->route('booking.success');
      } catch(\Exception $e){
        Log::error($e->getMessage());
      return redirect()->back()->with('error', 'Whoops, something went wrong.Could not book this property for inspection');
      }


       
      }

      public function success(Request $request)
{
    $booking = $request->session()->get('last_booking');
    $title = "Booking confirmed and successful";
    
    $propertyData = $this->propertyService->getPropertyById($booking['property_id']);   
    $property = $propertyData['property'];
    
    
    if (!$booking) {
        return redirect()->route('bookings.create');
    }
   
    return view('booking.success', compact('booking', 'title', 'property'));
}

}

