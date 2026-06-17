<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;




class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    return match ($this->tab) {

        'general' => [
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'currency' => ['nullable', 'string', 'max:3'],
            'locale' => ['nullable', 'string', 'max:5'],
            'timezone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email'],
            'year' => ['nullable','integer'],
            'address' => ['nullable'],
        ],
         'social' => [
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'whatsapp_url' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'youtube_url' => ['nullable', 'string', 'max:255'],
            'tiktok_url' => ['nullable', 'string', 'max:255'],
            'twitter_url' => ['nullable', 'string', 'max:255'],
            'pinterest_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
        ],

        'seo' => [
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'ga_id' => ['nullable', 'string'],
            'google_verification' => ['nullable', 'string'],
            'search_engine_indexing' => ['nullable', 'string']
        ],

         'security' => [
            'two_factor_enabled' => ['nullable', 'string'],
            'ip_whitelist_enabled' => ['nullable', 'string'],
            'whitelisted_ips' => ['nullable', 'string'],
            'session_timeout' => ['nullable', 'string'],
            'max_login_attempts' => ['nullable', 'string'],
           
        ],


         'email' => [
            'welcome_subject' => ['nullable', 'string'],
            'welcome_email' => ['nullable'],
            'booking_subject' => ['nullable', 'string'],
            'booking_email' => ['nullable', 'string'],
            'reset_subject' => ['nullable', 'string'],
            'reset_email' => ['nullable']
           
        ],


         'maintenance' => [
            'maintenance_mode' => ['nullable', 'string'],
            'maintenance_message' => ['nullable'],
            'maintenance_return_time' => ['nullable'],
            'maintenance_allowed_ips' => ['nullable'],
           
           
        ],


        default => [],
    };
}







    public function messages(): array
    {
        return [
            'category.required' => 'category is required',
            'question.required' => 'question is required',
            'answer' => 'answer is required address',
            'is_active' => 'status is required',
            'sort_id' => 'sort id is required',
            'sort_id.integer' => 'sort id  must be a number',
             'sort_id.unique' => 'sort id  must be unique',
        ];
    }
}