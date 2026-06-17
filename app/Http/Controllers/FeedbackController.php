<?php

namespace App\Http\Controllers;

use App\Contracts\Services\FeedbackServiceInterface;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\RedirectResponse;

  
class FeedbackController extends Controller
{
    //
    protected $feedBackService;

    public function __construct(FeedbackService $feedBackService){
          $this->feedBackService = $feedBackService;
    }



    public function store(Request $request):RedirectResponse
    {
 
    
        try{
         $data = $this->feedBackService->storeFeedback($request->all());

         return redirect()->route('contact')->with('success', 'Your feedback has been submitted successfully');


        } catch(\Exception $e){
            Log::info($e->getMessage());
        return redirect()->route('contact')->with('error', 'Whoops, something went wrong');
        }
    }




}
