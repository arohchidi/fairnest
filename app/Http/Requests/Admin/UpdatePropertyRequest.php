<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type_of_house' => ['required', 'string', Rule::in(['apartment', 'house', 'villa', 'condo', 'studio'])],
            'is_available' => ['required', 'string'],
            'roommate_preferences' => ['nullable', 'string', Rule::in(['false', 'true'])],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            
            'rent_fee' => ['required', 'numeric', 'min:0'],
            'agency_fee' => ['required', 'numeric', 'min:0'],
           
            'number_of_bedrooms' => ['required', 'integer', 'min:1'],
            'number_of_bathrooms' => ['required', 'numeric', 'min:0.5'],
           
            'is_furnished' => ['required', 'string', Rule::in(['false', 'true'])],
            
            'meta_data' => ['nullable', 'array'],
            
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'type_of_house.required' => 'Property type is required',
            'status.required' => 'Status is required',
            'address.required' => 'Address is required',
            'city.required' => 'City is required',
            
            'rent_fee.required' => 'Rent fee is required',
            'agency_fee.required' => 'Agency fee is required',
            
            'number_of_bedrooms.required' => 'Number of bedrooms is required',
            'number_of_bathrooms.required' => 'Number of bathrooms is required',
            
            'is_furnished.required' => 'Furnished status is required',
             'type_of_house.in' => 'Invalid property type selected',
            'roommate_preferences' => 'Invalid roommate preference selected',
            'images.*.image' => 'Each image must be a valid image file',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif',
            'images.*.max' => 'Each image must not exceed 2MB'
        ];
    }
}