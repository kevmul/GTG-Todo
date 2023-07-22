<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoProgressRequest extends FormRequest
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

    public function all($keys = null)
    {
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $acceptedProgress = collect(['new', 'in-progress', 'complete'])->join(',');
        return [
            'progress' => "in:{$acceptedProgress}",
        ];
    }

    public function messages()
    {
        return [
            'progress.in' => 'Progress should be one of "new", "in-progress", or "complete"'
        ];
    }
}
