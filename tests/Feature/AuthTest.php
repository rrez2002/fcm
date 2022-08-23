<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_can_register_user():void
    {
        $user = User::factory(1)->make()[0];

        $this->postJson(route("auth.register"), [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => 'password',
        ], [
            'Accept' => 'application/json'
        ])->assertCreated();
    }

    /**
     * @return void
     */
    public function test_can_login_user():void
    {
        $user = User::factory(1)->create()[0];

        $this->postJson(route("auth.login"), [
            'email' => $user->email,
            'password' => 'password',
        ], [
            'Accept' => 'application/json'
        ])->assertOk();
    }

    /**
     * @return void
     */
    public function test_can_get_information_user():void
    {
        $token = User::factory(1)->create()[0]->createToken("test")->plainTextToken;

        $this->get(route("auth.me"), [
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->assertOk();
    }

    /**
     * @return void
     */
    public function test_user_can_create_fcm_token():void
    {
        $user = User::factory(1)->create()[0];
        $token = $user->createToken("test")->plainTextToken;

        $this->postJson(route("auth.me"), [
            '_method' => "get",
            'user_id' => $user->id,
        ], [
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->assertOk();
    }
}
