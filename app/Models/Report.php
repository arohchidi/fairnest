<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'username',
        'property_id',
        'report_reason',
        'report_status',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
