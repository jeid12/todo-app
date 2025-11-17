<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'sometimes|required|date|date_format:Y-m-d|after_or_equal:today',
            'is_completed' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title must not exceed 255 characters.',
            'title.string' => 'The title must be a string.',
            'description.max' => 'The description must not exceed 1000 characters.',
            'description.string' => 'The description must be a string.',
            'due_date.required' => 'The due date field is required.',
            'due_date.date' => 'The due date must be a valid date.',
            'due_date.date_format' => 'The due date must be in format YYYY-MM-DD.',
            'due_date.after_or_equal' => 'The due date must be today or in the future.',
            'is_completed.boolean' => 'The is_completed field must be true or false.',
        ];
    }
}
