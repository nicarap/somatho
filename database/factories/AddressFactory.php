<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'street' => fake()->streetAddress(),
            'context' => fake()->secondaryAddress(),
            'postcode' => fake()->postcode(),
            'city' => fake()->city(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
        ];
    }
}
