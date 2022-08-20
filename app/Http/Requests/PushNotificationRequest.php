<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PushNotificationRequest extends FormRequest
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
        return [
            "users" => ['required', 'array'],
            "users.*" => ['required', 'int', 'exists:users,id'],
            //

            "title" => ['required', 'string', "max:255"],
            "body" => ['required', 'string'],
            "icon" => ['required', 'url'],
            "sound" => ['required', 'url'],
            "click_action" => ['required', 'string'],
            "banner" => ['required', 'url'],

            //
//            "condition" => ['required', 'string'],
//            "notification_key" => ['required', 'string'],
            //web
            "time_to_live" => ['required', 'integer', 'min:1'],
            "dry_run" => ['required', 'boolean'],
            "deep_link" => ['required', 'url'],
            "hide_notification_if_site_has_focus" => ['required', 'bool'],
            //ios
            "badge" => ['required', 'string'], // only ios
            "subtitle" => ['required', 'string'], // only ios
            //android
            "color" => ['required', 'string'], //except web
            "tag" => ['required', 'string'], // only android
        ];
    }
}
