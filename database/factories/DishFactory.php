<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement([
                'Tinolang Manok',
                'Adobong Baboy',
                'Sinigang na Hipon',
                'Pork Barbecue',
                'Ginataang Kalabasa',
                'Fried Bangus',
                'Sinugbang Panga',
                'Pancit Canton',
                'Lumpiang Shanghai',
                'Halo-Halo',
                'Mango Shake',
                'Puso Rice',
            ]),
            'price' => fake()->randomFloat(2, 35, 350),
            'is_bestseller' => fake()->boolean(25),
        ];
    }
}