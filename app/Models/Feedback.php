<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable = [
        'user_name',
        'user_email',
        'subject',
        'feedback_type',
        'message',
    ];
}
