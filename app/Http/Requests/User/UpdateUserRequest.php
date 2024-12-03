<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = request()->route()->parameter('user');

        return [
            'name'     => 'sometimes|string|max:255',
            'email'    => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $id,],
            'password' => 'sometimes|nullable|string',
        ];
    }
}
