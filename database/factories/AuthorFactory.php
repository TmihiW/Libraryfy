<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AuthorFactory extends Factory
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
            'birth_dt' => fake()->date(),
            'death_dt' => fake()->date(),
            'age' => fake()->numberBetween(20, 100),

        ];
    }
}
