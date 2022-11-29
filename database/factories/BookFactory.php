<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

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
            'b_name_' => fake()->name(),
            //id_barcode from book_barcode
            'page' => fake()->numberBetween(100, 1000),
            //double random price
            'price' => fake()->randomFloat(2, 0, 100),
            
            
        ];
    }
    
}
