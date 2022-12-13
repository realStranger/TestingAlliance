<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
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
            'login' => fake()->userName(),
            'password' => fake()->password(),
            'name' => fake()->randomElement(['Samsung Pro', 'Xiaomi', 'Iphone 12', 'Desktop'])
        ];
    }
}
