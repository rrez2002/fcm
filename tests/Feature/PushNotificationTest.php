<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PushNotificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_publish_to_users():void
    {
        $user = User::factory(1)->create()[0];
        // send push_notification to users
        $users = User::factory(5)->create();
        $token = $user->createToken("test")->plainTextToken;

        $this->postJson(route("push_notification.publishToUsers"), [
            "users" => $users->map(fn($user) => (string)$user->id),

            "title" => "::title::",
            "body" => "::body::",
            "icon" => fake()->url("icon"),
            "sound" => fake()->url("sound"),
            "click_action" => "::click_action::",
            "banner" => fake()->url("banner"),

            //
//            "condition" => ['required', 'string'],
//            "notification_key" => ['required', 'string'],
            //web
            "time_to_live" => fake()->randomDigitNotNull(),
            "dry_run" => fake()->boolean,
            "deep_link" => fake()->url(),
            "hide_notification_if_site_has_focus" => fake()->boolean,
            //ios
            "badge" => "::badge::",
            "subtitle" => "::subtitle::",
            //android
            "color" => fake()->randomElement(["#ccc", "#fff", "#000"]),
            "tag" => "::tag::",
        ], [
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->assertOk();
    }
}
