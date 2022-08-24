<?php

namespace Database\Factories;

use App\Enums\DeviceTypeEnum;
use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => fake()->uuid,
            'type' => fake()->randomElement(DeviceTypeEnum::cases()),
        ];
    }
}
