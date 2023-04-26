<?php

namespace Database\Factories;

use App\Models\Roles;
use App\Models\Therapist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Therapist>
 */
class TherapistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->make();

        return array_merge($user->toArray(), [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'siren' => fake()->company(),
        ]); 
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Therapist $therapist) {
            $therapist->assignRole(Roles::THERAPIST);
        });
    }
}
