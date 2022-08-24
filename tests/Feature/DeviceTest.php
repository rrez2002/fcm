<?php

namespace Tests\Feature;

use App\Enums\DeviceTypeEnum;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeviceTest extends TestCase
{
    /**
     * add device
     *
     * @return void
     */
    public function test_can_add_device(): void
    {
        $user = User::factory(1)->create()[0];
        $token = $user->createToken("test")->plainTextToken;

        $this->postJson(route("devices.store"), [
            'uuid' => fake()->uuid,
            'type' => fake()->randomElement(DeviceTypeEnum::cases()),
        ], [
            'Accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->assertCreated();
    }
}
