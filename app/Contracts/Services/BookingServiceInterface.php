<?php

namespace App\Contracts\Services;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookingServiceInterface
{
    public function storeBooking(array $data);

   


}
  