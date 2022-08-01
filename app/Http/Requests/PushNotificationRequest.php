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
            //
            "registration_ids" => ['required', 'array'],
            "registration_ids.*" => ['required', 'string'],
            "condition" => ['required', 'string'],
            "notification_key" => ['required', 'string'],

            "time_to_live" => ['required', 'integer', 'min:1'],
            "dry_run" => ['required', 'boolean'],
            //web
            "icon" => ['required', 'url'],
            "deep_link" => ['required', 'url'],
            "hide_notification_if_site_has_focus" => ['required', 'bool'],
            "click_action" => ['required', 'string'],
            //ios
            "sound" => ['required', 'string'],
            "badge" => ['required', 'string'], // only ios
            "subtitle" => ['required', 'string'], // only ios
            "body_loc_key" => ['required', 'string'],
            "body_loc_args" => ['required', 'json'],
            "title_loc_key" => ['required', 'string'],
            "title_loc_args" => ['required', 'json'],
            //android
            "android_channel_id" => ['required', 'string'], // only android
            "color" => ['required', 'string'], // only android
            "tag" => ['required', 'string'], // only android

            "restricted_package_name" => ['required', 'string'], // only android

        ];
    }
}
