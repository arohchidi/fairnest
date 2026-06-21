<?php

namespace App\Http\Controllers\Admin;


use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class ReviewController extends Controller
{
    //
    protected $reviewService;
    public function __construct(AdminReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }




    public function index():View
    {
         $data = $this->reviewService->reviews();
         $reviews = $data['reviews'];
         $statistics = $data;
      
    return view('admin.reviews.index', compact('reviews', 'statistics'));
    }

    public function toggleStatus(int $id, Request $request):RedirectResponse
    {
        try{

        $this->reviewService->toggleStatus($id, $request['status']);
         return redirect()->route('admin.reviews.index')->with('success', 'Review status has been updated successfully');

        } catch(\Throwable $e){
            Log::error([$e->getMessage(), $e->getTrace()]);
            return redirect()->route('admin.reviews.index')->with('error', 'Something went wrong');
        }
    }


    public function destroy(int $id):RedirectResponse
    {
        try{
          $this->reviewService->destroy($id);
           return redirect()->route('admin.reviews.index')->with('success', 'Deleted successfully');
        } catch(\Throwable $e){
Log::error([$e->getMessage(), $e->getTrace()]);
            return redirect()->route('admin.reviews.index')->with('error', 'Something went wrong');
        }
    }
}
