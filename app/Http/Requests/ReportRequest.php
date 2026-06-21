<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;




class ReportRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
                 'photo' => ['nullable', 'array'],
    'photo.*' => ['nullable','image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    'anonymous' => ['nullable','integer'],
    
    
           
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Username is required',
            'email.required' => 'Email address is required',
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'category.required' => 'category is required',
            'photo.*.image' => 'Each image must be a valid image file',
            'photo.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif',
            'photo.*.max' => 'Each image must not exceed 2MB'
        ];
    }
}