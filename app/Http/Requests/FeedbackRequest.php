<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;




class FeedbackRequest extends FormRequest
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
            'feedback_type' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
           
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Username is required',
            'email.required' => 'Email address is required',
            'phone.required' => 'Phone number is required',
            'feedback_type.required' => 'Type of Feedback is required',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
        ];
    }
}