<?php

namespace App\Contracts\Services;
use Illuminate\Pagination\LengthAwarePaginator;

interface FeedbackServiceInterface
{
    public function storeFeedback(array $data);


}
  