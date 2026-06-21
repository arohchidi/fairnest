<?php
namespace App\Contracts\Services;
use App\Models\Booking;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdminBookingServiceInterface
{
    public function bookings(array $filters):array;
    public function show(int $id):Booking;
    public function destroy(int $id):bool;
    public function toggleStatus(int $id, string $data):Booking;
   
}






?>