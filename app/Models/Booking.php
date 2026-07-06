<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   
 use HasFactory;
//
    protected $fillable = [
        'username',
        'email',
        'phone',
        'property_id',
        'booking_date',
        'status',
        'needs_roommate',
        'roommate_gender',
        'roommate_age',
        'roommate_level',
        'state_of_origin',
        'religion',
        'roommate_note',
        'special_request',

    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
