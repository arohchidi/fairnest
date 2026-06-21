<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\AdminReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class ReportController extends Controller
{
    //
protected $reportService;

public function __construct(AdminReportService $reportService){
$this->reportService = $reportService;
}

public function index():View{

$statistics = $this->reportService->reports();
$reports = $statistics['reports'];


return view('admin.reports.index', compact('reports', 'statistics'));
}


public function show(int $id)
{
   
    try{
        $report = $this->reportService->show($id);
        
        
        return view('admin.reports.show', compact('report'));

    }catch(\Exception $e){
        Log::error([$e->getMessage(),
        $e->getTrace()]);
        //return view('admin.reports.index');
    }
}

public function toggleStatus(int $id, Request $request):RedirectResponse
{
    
   try{
     $this->reportService->toggleStatus($id, $request['status']);
    return redirect()->back()->with('success', 'Report status has been updated successfully');
   } catch(\Throwable $e)
   {
    Log::error([$e->getMessage(), $e->getTrace()]);
    return redirect()->back()->with('error', 'Whoops, something went wrong');
   }

}

public function destroy(int $id):RedirectResponse
{
    try{
     
     $this->reportService->destroy($id);
     return redirect()->route('admin.reports.index')->with('success', 'Report status has been deleted successfully');
    } catch (\Throwable $e){
         Log::error([$e->getMessage(), $e->getTrace()]);
    return redirect()->back()->with('error', 'Whoops, could not delete this report');
    }
}


}
