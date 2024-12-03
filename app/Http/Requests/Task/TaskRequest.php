<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // I have created only one form request and use it in Task creation and update endpoints, based on what was mentioned in the file.
        return [
            'title'              => 'required|string',
            'description'        => 'required|string',
            'status'             => ['sometimes', 'string', Rule::in(TaskStatus::values())],
            'images'             => 'nullable|array',
            'images.*'           => 'nullable|image|max:2048',
            'images_ids'         => 'nullable|array',
            'images_ids.*'       => 'nullable|integer|min:1',
        ];
    }
}
