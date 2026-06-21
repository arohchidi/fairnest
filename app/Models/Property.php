<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
            'user_id',
        'title',
        'description',
        'rent_fee',
        'agency_fee',
        'address',
        'city',
        'country',
        'type_of_house',
        'number_of_bedrooms',
        'number_of_bathrooms',
        'number_of_parking_spaces',
        'is_furnished',
        'is_available',
        'roommate_preferences',
        'images',
        'meta_data',
    ];


     protected  $casts  = [
        'images' => 'array',
        'meta_data' => 'array',
        
     ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }


}
