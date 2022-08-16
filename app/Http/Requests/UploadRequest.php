<?php

namespace App\Http\Requests;

use App\Rules\FileTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => ['required', 'string', Rule::in('icon','image','song')],
            'file' => ['required', File::default()->max(20 * 1024),
                new FileTypeRule($this->input("type"))],
        ];
    }
}
