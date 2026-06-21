<?php

namespace App\Http\Controllers;
use App\Models\Report;
use App\Services\ReportService;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;



class ReportController extends Controller
{
    //
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
      $this->reportService = $reportService;
    }


    public function store(ReportRequest $request, int $id):RedirectResponse
    {

    try{
        $data = $request->validated();

$data['photo'] = $request->file('photo');
      
     $this->reportService->storeReport($data, $id); 

     return redirect()->back()->with('success', 'Your report has been submitted successfully');
    } catch(\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'Whoops, something went wrong');

    }
       
    }

}
