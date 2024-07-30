<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'email' => 'email|required|string|max:255|unique:users',
            'name' => 'string|required|max:255|min:5',
            'username' => 'string|required|max:255|min:3',
            'password' => 'string|required|max:255|min:8|confirmed',
        ];
    }
}
