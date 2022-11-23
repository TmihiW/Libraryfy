<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_' => fake()->name(),
            'surname_' => fake()->lastName(),
            'name_surname_' => fake()->name() . ' ' . fake()->lastName(),
            'username_' => fake()->userName(),
            'password' => bcrypt('password'),
            'age' => fake()->numberBetween(18, 99),
            'adress' => fake()->address(),
            'role_id' => fake()->numberBetween(1, 3),
            'times_rented' => fake()->numberBetween(0, 100),
            'email' => fake()->email(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

            //'email' => fake()->unique()->safeEmail(),
            //'email_verified_at' => now(),
            //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
