<?php

namespace App\Http\Requests;

use App\Rules\DeviceTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'uuid' => ['required', 'uuid', 'unique:devices,uuid'],
            'type' => ['required' , new DeviceTypeRule()],
        ];
    }
}
