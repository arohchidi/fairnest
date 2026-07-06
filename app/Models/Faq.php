<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
 use HasFactory;   
//
    protected $table = "faqs";
    protected $fillable = [
        'sort_id',
        'question',
        'answer',
        'is_active',
        'category',
       
    ];
}
