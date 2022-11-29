<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
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
            'b_name_' => fake()->bookname(),
            //'id_barcode' => BookBarcode::factory(),
            //random page number
            'pages' => fake()->numberBetween(100, 1000),
            //'page' => Str::random(3),
            //double random price
            
            
        ];
    }
}
