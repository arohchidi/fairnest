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
            'email' => ['required','email', 'confirmed'],
            'phone' => ['required', 'string'],
            'property_id' => ['required', 'string'],
            'booking_date' => ['required', 'string'],
            'needs_roommate' => ['required', 'string'],
            'roommate_gender' => ['sometimes', 'string'],
            'roommate_age' => ['sometimes', 'integer'],
            'roommate_level' => ['sometimes', 'string'],
            'state_of_origin' => ['sometimes', 'string'],
            'religion' => ['sometimes', 'string'],
            'roommate_note' => ['sometimes', 'string'],
            'special_request' => ['sometimes', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'phone' => 'Phone number is required',
            'email.confirmed' => 'Email needs to be confirmed',
        ];
    }
}