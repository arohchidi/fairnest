<?php

namespace App\Services\Admin;


use App\Contracts\Services\AdminBookingServiceInterface;

use App\Models\Booking;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;


class AdminBookingService implements AdminBookingServiceInterface
{

protected $propertyModel;
protected $bookingModel;
protected $settings;

public function __construct(Booking $booking, Setting $settings){
    $this->bookingModel = $booking;
    $this->settings = Setting::first();
}


public function bookings(array $filters):array
{

$query = Booking::with(['property']);
        // Search filter
        if ($filters['search'] ?? null) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->whereHas('booking', function($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                       ->orWhere('username', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('property', function($pq) use ($search) {
                    $pq->where('title', 'like', "%{$search}%");
                });
            });
        }

        if($filters['status'] ?? null){
            $query->where('status', $filters['status']);
        }

        if($filters['date_from'] ?? null){
            $query->whereDate('created_at' , '>=',  $filters['date_from']);
        }

         if($filters['date_to'] ?? null){
            $query->whereDate('created_at' , '>=',  $filters['date_to']);
        }

  $stats = $this->bookingModel
    ->selectRaw("
        COUNT(CASE WHEN status = 'active' THEN 1 END) as active,
        COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending,
        COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed,
        COUNT(CASE WHEN status = 'cancelled' THEN 1 END) as cancelled
    ")
    ->first();

    return [
    'active' => $stats->active,
    'pending' => $stats->pending,
    'completed' => $stats->completed,
    'cancelled' => $stats->cancelled,
    'bookings' => $query
        ->latest()
        ->paginate(10),
];




}


public function show($id):Booking
{

  $booking = $this->bookingModel->findOrFail($id);

  return $booking;

}


	public function destroy(int $id):bool
    {
       $booking = $this->bookingModel->findOrFail($id);
       return  $booking->delete();
    }

  
    public function toggleStatus(int $id, string $data): Booking
    {
        $booking = $this->bookingModel->findOrFail($id);
        $email = $booking->email;
        $username = $booking->username;
        $booking->update(['status' => $data]);
         

         $bookings = $this->bookingModel->findOrFail($id);
         $propertytitle = $bookings->property->title;
        
        //send email
         $this->sendBookingEmail($email,$username,$data,$propertytitle,$bookings);

        return $booking;

    }

    private function sendBookingEmail(string $email, string $username, string $status,$propertytitle,$bookings)

    {

        Mail::to($email)
            ->queue(
                new BookingConfirmationMail(
                   
                    $username,
                    $this->settings->booking_email,
                    $this->settings->booking_subject,
                    $propertytitle,
                    $bookings,

                )
            );
    }



}