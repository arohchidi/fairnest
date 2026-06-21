<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use App\Models\Property;
use App\Models\Review;
use  App\Http\Requests\ReviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;



class ReviewController extends Controller
{
    //
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
       $this->reviewService = $reviewService;
    }


     public function store(ReviewRequest $request, int $id):RedirectResponse
     {
  
         try{
            $this->reviewService->store($request->validated(), $id);
            return redirect()->back()->with('success','Your review has been submitted successfully');

         } catch(\Exception $e){
            Log::error($e->getMessage());
             return redirect()->back()->with('error','Whoops, something went wrong');
         }
        
     }

}
