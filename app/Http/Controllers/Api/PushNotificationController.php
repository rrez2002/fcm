<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PushNotificationRequest;
use App\Http\Resources\PushNotificationCollection;
use App\Models\PushNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Pusher\PushNotifications\PushNotifications;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PushNotificationCollection
     */
    public function index()
    {
        return new PushNotificationCollection(Auth::user()->push_notifiable()->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PushNotificationRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function publishToUsers(PushNotificationRequest $request)
    {
        $data = $request->validated();


        $PushNotification = new PushNotifications([
            "instanceId" => config('broadcasting.connections.pusher.beams_instance_id'),
            "secretKey" => config('broadcasting.connections.pusher.beams_secret_key'),
        ]);
        $PushNotification->publishToUsers(
            $data['users'],
            [
                "web" => [
                    "time_to_live" => $data['time_to_live'],
                    "dry_run" => $data['dry_run'],

                    "notification" => [
                        "title" => $data['title'],
                        "body" => $data['body'],
                        "icon" => $data['icon'],
                        "sound" => $data['sound'],
                        "deep_link" => $data['deep_link'],
                        "hide_notification_if_site_has_focus" => $data['hide_notification_if_site_has_focus'],
                        "click_action" => $data['click_action'],
                    ]
                ],
                "fcm" => [
                    "sound" => $data['sound'],
                    "notification" => [
                        "title" => $data['title'],
                        "body" => $data['body'],
                        "icon" => $data['icon'],
                        "color" => $data['color'],
                        "tag" => $data['tag'],
                        "android_channel_id" => $data['android_channel_id'],
                        "click_action" => $data['click_action'],

                        "body_loc_key" => $data['body_loc_key'],
                        "body_loc_args" => $data['body_loc_args'],
                        "title_loc_key" => $data['title_loc_key'],
                        "title_loc_args" => $data['title_loc_args'],
                    ]
                ],
                "apns" => [
                    'sound' => $data['sound'],
                    'badge' => $data['badge'],
                    "alert" => [
                        "title" => $data['title'],
                        "body" => $data['body'],
                        "icon" => $data['icon'],
                        "color" => $data['color'],

                        "click_action" => $data['click_action'],

                        "body_loc_key" => $data['body_loc_key'],
                        "body_loc_args" => $data['body_loc_args'],
                        "title_loc_key" => $data['title_loc_key'],
                        "title_loc_args" => $data['title_loc_args'],
                    ]
                ],

            ]
        );

        return new JsonResponse(['message' => __("message.sended", ["attribute" => __("push notification")])], Response::HTTP_NOT_FOUND);
    }


    /**
     * @param PushNotificationRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function publishToInterests(PushNotificationRequest $request)
    {
        $data = $request->validated();

        $PushNotification = new PushNotifications([
            "instanceId" => config('broadcasting.connections.pusher.beams_instance_id'),
            "secretKey" => config('broadcasting.connections.pusher.beams_secret_key'),
        ]);
        $PushNotification->publishToInterests(
            $data['interests'],
            [
                "web" => [
                    "time_to_live" => $data['time_to_live'],
                    "dry_run" => $data['dry_run'],

                    "notification" => [
                        "title" => $data['title'],
                        "body" => $data['body'],
                        "icon" => $data['icon'],
                        "sound" => $data['sound'],
                        "deep_link" => $data['deep_link'],
                        "hide_notification_if_site_has_focus" => $data['hide_notification_if_site_has_focus'],
                        "click_action" => $data['click_action'],
                    ]
                ],
                "fcm" => [
                    "sound" => $data['sound'],
                    "notification" => [
                        "title" => $data['title'],
                        "body" => $data['body'],
                        "icon" => $data['icon'],
                        "color" => $data['color'],
                        "tag" => $data['tag'],
                        "android_channel_id" => $data['android_channel_id'],
                        "click_action" => $data['click_action'],

                        "body_loc_key" => $data['body_loc_key'],
                        "body_loc_args" => $data['body_loc_args'],
                        "title_loc_key" => $data['title_loc_key'],
                        "title_loc_args" => $data['title_loc_args'],
                    ]
                ],
                "apns" => [
                    'sound' => $data['sound'],
                    'badge' => $data['badge'],
                    "alert" => [
                        "title" => $data['title'],
                        "body" => $data['body'],
                        "icon" => $data['icon'],
                        "color" => $data['color'],

                        "click_action" => $data['click_action'],

                        "body_loc_key" => $data['body_loc_key'],
                        "body_loc_args" => $data['body_loc_args'],
                        "title_loc_key" => $data['title_loc_key'],
                        "title_loc_args" => $data['title_loc_args'],
                    ]
                ],

            ]
        );

        return new JsonResponse(['message' => __("message.sended", ["attribute" => __("push notification")])], Response::HTTP_NOT_FOUND);
    }

}
