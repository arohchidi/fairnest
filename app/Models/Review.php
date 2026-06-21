<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //

    protected $fillable = [
      
     'property_id',
     'name',
     'ratings',
     'comment',
     'property_id',
     'status',

    ];


    public function property(){
        return $this->belongsTo(Property::class);
    }
}
