<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;




class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => ['required', 'string', 'max:255'],
            'question' => ['required'],
            
            'answer' => ['required', 'string'],
            'is_active' => ['required'],
            'sort_id' => ['required', 'integer', Rule::unique('faqs', 'sort_id')->ignore($this->route('id'))],
            
        ];
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