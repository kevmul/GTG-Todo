<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = collect();
        if ($this->method() === "PATCH") {
            $rules->push([
                'title' => 'required|min:3|max:100'
            ]);
        }
        return $rules->toArray()[0] ?? $rules->toArray();
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.max' => 'The title cannot exceed 100 characters.'
        ];
    }
}
