<?php
namespace App\Contracts\Services;
use App\Models\Review;


interface AdminReviewServiceInterface
{
    public function reviews():array;
    public function destroy(int $id);
    public function toggleStatus(int $id, string $data):Review;
    public function show(int $id):Review;
}






?>