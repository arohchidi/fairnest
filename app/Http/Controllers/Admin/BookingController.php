<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\Admin\AdminBookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class BookingController extends Controller
{
    //


   protected $bookingService;

   public function __construct(AdminBookingService $bookingService){
    $this->bookingService = $bookingService;
   }



    public function index(Request $request):View{



    $filters = $request->only(['search','status','date_from', 'date_to']);

   $booking_array =  $this->bookingService->bookings($filters);

   $data['statistics'] = $booking_array;
  
   $bookings = $booking_array['bookings'];

   return view('admin.bookings.index', ['bookings' => $bookings, 'statistics' => $data['statistics']]);
    }


    public function show($id):View
    {
       
       $booking = $this->bookingService->show($id);

       

     return view('admin.bookings.show',compact('booking'));

    }

    public function destroy(int $id):RedirectResponse
    {
        try{
            $booking = $this->bookingService->destroy($id);
            return redirect()->route('admin.bookings.index')->with('success','Booking has been deleted successfully');
        } catch(\Exception $e){
          Log::error($e->getMessage());
          return redirect()->route('admin.bookings.index')->with('error','Something went wrong');
        }
    }

    public function toggleStatus(Request $request,int $id):RedirectResponse
    {
        try{
             $booking = $this->bookingService->toggleStatus($id,$request['status']);
            return redirect()->route('admin.bookings.index')->with('success','Booking has been deleted successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
             return redirect()->route('admin.bookings.index')->with('error','Something went wrong');
        }
    }
}
