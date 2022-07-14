<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeamsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => ['required']
        ];
    }
}
