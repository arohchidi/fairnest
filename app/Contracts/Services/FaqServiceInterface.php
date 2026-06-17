<?php

namespace App\Contracts\Services;
use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;

interface FaqServiceInterface
{
   public function getFaqs():array;
   public function storeFaq(array $data);
   public function getFaqById(int $id);
   public function updateFaq(int $id, array $data);
   public function toggleStatus(int $id):Faq;
   public function deleteFaq(int $id):bool;
}
  