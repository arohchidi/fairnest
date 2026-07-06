<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'preferred_location' => 'required|string|max:100',
            'apartment_type' => 'required|string|max:50',
            'budget' => 'required|string|max:50',
            'move_in_timeline' => 'required|string|max:50',
            'occupancy_type' => 'required|string|max:50',
            'roommate_needed' => 'required|string|max:20',
            'inspection_reference' => 'required|string|max:50',
            'requirements' => 'nullable|array',
            'requirements.*' => 'string',
            'notes' => 'nullable|string',
            'terms' => 'required|accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required',
            'phone.required' => 'Phone number is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'preferred_location.required' => 'Preferred location is required',
            'apartment_type.required' => 'Apartment type is required',
            'budget.required' => 'Budget is required',
            'move_in_timeline.required' => 'Move-in timeline is required',
            'occupancy_type.required' => 'Occupancy type is required',
            'roommate_needed.required' => 'Please select if you need a roommate',
            'inspection_reference.required' => 'Inspection reference is required',
            'terms.accepted' => 'You must accept the terms and conditions',
        ];
    }
}