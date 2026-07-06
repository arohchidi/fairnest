<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;



class Setting extends Model
{
 use HasFactory;    
//
    protected $table = "settings";
    protected $fillable = [
        'phone',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'whatsapp_url',
        'linkedin_url',
        'youtube_url',
        'pinterest_url',
        'tiktok_url',
        'terms',
        'privacy',
        'year',
        'address',
        'email',
        'locale',
        'site_tagline',
        'site_name',
        'timezone',
        'currency',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'ga_id',
        'google_verification',
        'search_engine_indexing',
        'two_factor_enabled',
        'ip_whitelist_enabled',
        'whitelisted_ips',
        'session_timeout',
        'max_login_attempts',
        'welcome_subject',
        'welcome_email',
        'booking_subject',
        'booking_email',
        'reset_subject',
        'reset_email',
        'maintenance_mode',
        'maintenance_message',
        'maintenance_return_time',
        'maintenance_allowed_ips',
        'privacy',
        'terms',

       
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('site_settings');
        });

        static::deleted(function () {
            Cache::forget('site_settings');
        });
    }
}
