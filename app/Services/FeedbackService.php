<?php

namespace App\Services;

use App\Contracts\Services\FeedbackServiceInterface;

use App\Models\Feedback;


use Override;

class FeedbackService implements FeedbackServiceInterface {

protected $feedBackModel;
public function __construct(Feedback $model){
 $this->feedBackModel = $model;

}


#[Override]
	public function storeFeedback(array $data)
    {
       
 
       $feedback = $this->feedBackModel->create([
       'name' => $data['name'],
       'feedback_type' => $data['feedback_type'],
       'email' => $data['email'],
       'phone' => $data['phone'],
       'subject' => $data['subject'],
       'message' => $data['message'],
       
       ]);

       return $feedback;
    }


    #[Override]
    public function feedbacks(): array
    {
        $feedbacks = $this->feedBackModel;
         $pending = $feedbacks->where('status','pending')->count();

         $in_progress =  $feedbacks->where('status','in_progress')->count();
         $resolved =  $feedbacks->where('status','resolved')->count();

       

        return ['feedbacks' => $feedbacks->orderby('id','DESC')->paginate(),'pending' => $pending, 'in_progress' => $in_progress, 'resolved' => $resolved, 'total' => $pending + $in_progress + $resolved];


    }

    #[Override]
    public function toggleStatus(int $id, string $status)
    {
        $feedback = $this->feedBackModel->findOrFail($id);
       return  $feedback->update(['status' => $status]);
        
    }


    public function destroy(int $id):bool
    {
         $feedback = $this->feedBackModel->findOrFail($id);
         return $feedback->delete();
    }

}





?>