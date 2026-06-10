<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'username',
        'property_id',
        'booking_date',
        'status',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
