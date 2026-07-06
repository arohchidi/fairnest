<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'preferred_location',
        'apartment_type',
        'budget',
        'move_in_timeline',
        'occupancy_type',
        'roommate_needed',
        'inspection_reference',
        'requirements',
        'notes',
        'status',
        'admin_note',
    ];

    protected $casts = [
        'requirements' => 'array',
        'status' => 'string',
    ];
}