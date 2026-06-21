<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;





class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
      
        return [
            'name' => ['required', 'string', 'max:255'],
          
            'comment' => ['required', 'string', 'max:255'],
            'ratings' => ['required'],
            
    
    
           
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Username is required',
           
            'comment.required' => 'Comment is required',
            'ratings.required' => 'Rating is required',
            
        ];
    }
}