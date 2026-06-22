<?php

namespace App\Services\Admin;


use App\Contracts\Services\AdminReportServiceInterface;
use App\Mail\ReportMail;
use App\Models\Report;
use App\Models\Property;
use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;


class AdminReportService implements AdminReportServiceInterface
{

protected $reportModel;
protected $propertyModel;
protected $settings;

public function __construct(Report $report, Property $property, Setting $setting){
    $this->reportModel = $report;
    $this->propertyModel = $property;
    $this->settings = Setting::first();
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
       $email = $report->email;
        $username = $report->name;
        $this->sendReportEmail($email, $data, $report);

        return $report;

    }


    public function show(int $id):Report
    {
        $report = $this->reportModel->findOrFail($id);
       
       
        return $report;

    }

    private function sendReportEmail(string $email,string $status, $report)
    {
        Mail::to($email)
            ->queue(
                new ReportMail(
                   $this->settings->booking_email,
                    $this->settings->booking_subject,
                    $status,
                    $report,

                )
            );
    }


}