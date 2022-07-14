<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar' => ['nullable', 'image'],
            'first_name' => ['required', 'string', "max:30"],
            'last_name' => ['required', 'string', "max:30"],
            'email' => ['required', 'email', "unique:users,email"],
            'password' => ['required', Password::min(8)],
        ];
    }
}
