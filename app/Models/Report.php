<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
 use HasFactory;    
//
    protected $fillable = [
        'email',
        'name',
        'property_id',
        'title',
        'photo',
        'description',
        'category',
        'anonymous',
        'status',
    ];

    protected $casts = [
        'photo' =>  'array',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
