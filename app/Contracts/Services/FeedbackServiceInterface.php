<?php

namespace App\Contracts\Services;
use Illuminate\Pagination\LengthAwarePaginator;

interface FeedbackServiceInterface
{
    public function storeFeedback(array $data);

    public function feedbacks():array;
    public function toggleStatus(int $id, string  $data);
    public function destroy(int $id):bool;


}
  