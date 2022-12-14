<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            //'id_user' => User::factory(),
            //'id_book' => Book::factory(),
            'return_time' => fake()->dateTimeBetween('now', '+1 years'),
        ];
    }
}
