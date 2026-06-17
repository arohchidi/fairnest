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

}





?>