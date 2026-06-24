<?php

namespace App\Http\Controllers;

use App\Contracts\Services\FeedbackServiceInterface;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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


    //get the feedbacks
    public function feedbacks():View
    {
        $data =$this->feedBackService->feedbacks();
        $statistics = $data;
        
        $feedbacks = $data['feedbacks'];
        return view('admin.feedback.index',compact('feedbacks', 'statistics'));
    }

    public function toggleStatus(int $id, Request  $request):RedirectResponse
    {
        try{

             $this->feedBackService->toggleStatus($id, $request['status']);
              return redirect()->route('admin.feedback.index')->with('success', 'Status has been updated successfully');
        } catch(\Throwable $e){
            Log::error(['trace' => $e->getTrace(), 'message' => $e->getMessage()]);
             return redirect()->route('admin.feedback.index')->with('error', 'Whoops, something went wrong');
        }
    }



}
