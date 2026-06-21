<?php

namespace App\Services\Admin;


use App\Contracts\Services\AdminReportServiceInterface;

use App\Models\Report;
use App\Models\Property;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminReportService implements AdminReportServiceInterface
{

protected $reportModel;
protected $propertyModel;

public function __construct(Report $report, Property $property){
    $this->reportModel = $report;
    $this->propertyModel = $property;
}




public function reports():array
{
    $query = $this->reportModel->orderby('id', 'ASC');
    $total = $this->reportModel->count();
    $resolved = $this->reportModel->where('status','resolved')->count();
    $pending = $this->reportModel->where('status','pending')->count();
    $in_review = $this->reportModel->where('status','in_review')->count();
    return ['reports' => $query->paginate(),
    'resolved' => $resolved,
    'pending' => $pending,
    'in_review' => $in_review,
    ];
}


	public function destroy(int $id)
    {
       return $this->reportModel->findOrFail($id)->delete();
      
    }

  
    public function toggleStatus(int $id, string $data):Report
    {

   
        $report = $this->reportModel->findOrFail($id);
      $report->update(['status' => $data]);

        return $report;

    }


    public function show(int $id):Report
    {
        $report = $this->reportModel->findOrFail($id);
       
        return $report;

    }


}