<?php

namespace App\Services;
use App\Models\Booking;
use App\Contracts\Services\BookingServiceInterface;
use Override;

class BookingService implements BookingServiceInterface
{

protected $bookingModel;   

public function __construct(Booking $model){
    $this->bookingModel = $model;
}



#[Override]
	public function storeBooking(array $data)
    {
        
       $book =  $this->bookingModel->create([
        'username' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'property_id' => $data['property_id'],
        'booking_date' => $data['booking_date'],
        'needs_roommate' => $data['needs_roommate'] ?? null,
        'roommate_gender' => $data['roommate_gender'] ?? null,
        'roommate_age' => $data['roommate_age'] ?? null,
        'roommate_level' => $data['roommate_level'] ?? null,
        'state_of_origin' => $data['state_of_origin'] ?? null,
        'religion' => $data['religion'] ?? null,
        'roommate_note' => $data['roommate_note'] ?? null,
        'special_request' => $data['special_request'] ?? null,
       ]);

       return $book;

        
    
    }


    
}





?>