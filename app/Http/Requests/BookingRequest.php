<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;




class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email'],
            'phone' => ['required', 'string'],
            'property_id' => ['required'],
            'booking_date' => ['required'],
            'needs_roommate' => ['nullable', 'string'],
            'roommate_gender' => ['nullable', 'string'],
            'roommate_age' => ['nullable', 'integer'],
            'roommate_level' => ['nullable', 'string'],
            'state_of_origin' => ['nullable', 'string'],
            'religion' => ['nullable', 'string'],
            'roommate_note' => ['nullable', 'string'],
            'special_request' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'phone' => 'Phone number is required',
            
        ];
    }
}