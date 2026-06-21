<?php

namespace App\Services\Admin;


use App\Contracts\Services\AdminReviewServiceInterface;

use App\Models\Review;



class AdminReviewService implements AdminReviewServiceInterface
{

protected $reviewModel;


public function __construct(Review $review){
    $this->reviewModel = $review;
   
}




public function reviews():array
{
    $query = $this->reviewModel->orderby('id', 'ASC');
    $total = $this->reviewModel->count();
   
    $pending = $this->reviewModel->where('status','pending')->count();
    $approved = $this->reviewModel->where('status','approved')->count();
     $flagged = $this->reviewModel->where('status','flagged')->count();
    return ['reviews' => $query->paginate(),
    'pending' => $pending,
    'total' => $total,
    'approved' => $approved,
    'flagged' => $flagged,
    ];
}


	public function destroy(int $id)
    {
       return $this->reviewModel->findOrFail($id)->delete();
      
    }

  
    public function toggleStatus(int $id, string $data):Review
    {

   
        $report = $this->reviewModel->findOrFail($id);
      $report->update(['status' => $data]);

        return $report;

    }


    public function show(int $id):Review
    {
        $report = $this->reviewModel->findOrFail($id);
       
        return $report;

    }


}