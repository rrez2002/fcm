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
        return $this->user()->isAdmin();
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
            "to" => ['nullable', 'string'],
            "registration_ids" => ['nullable', 'array'],
            "registration_ids.*" => ['nullable', 'string'],
            "condition" => ['nullable', 'string'],
            "notification_key" => ['nullable', 'string'],

            "time_to_live" => ['nullable', 'integer', 'min:1'],
            "dry_run" => ['nullable', 'boolean'],
            //web
            "icon" => ['nullable', 'url'],
            "deep_link" => ['nullable', 'url'],
            "hide_notification_if_site_has_focus" => ['nullable', 'bool'],
            "click_action" => ['nullable', 'string'],
            //ios
            "sound" => ['nullable', 'string'],
            "badge" => ['nullable', 'string'], // only ios
            "subtitle" => ['nullable', 'string'], // only ios
            "body_loc_key" => ['nullable', 'string'],
            "body_loc_args" => ['nullable', 'json'],
            "title_loc_key" => ['nullable', 'string'],
            "title_loc_args" => ['nullable', 'json'],
            //android
            "android_channel_id" => ['nullable', 'string'], // only android
            "color" => ['nullable', 'string'], // only android
            "tag" => ['nullable', 'string'], // only android

            "restricted_package_name" => ['nullable', 'string'], // only android

        ];
    }
}
