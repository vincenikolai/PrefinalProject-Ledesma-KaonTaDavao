<?php

namespace Database\Factories;

use App\Models\Eatery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            'user_id' => User::inRandomOrder()->first()->id,
            'rating' => fake()->numberBetween(1, 5),
            'body' => fake()->randomElement([
                'Lami kaayo ang sabaw, mubalik jud ko diri.',
                'Sakto ra ang lasa pero medyo dugay ang serve.',
                'Sulit kaayo sa presyo, dako ang serving.',
                'Okay ra, pero init kaayo sa sulod.',
                'Best kinilaw nga natilawan nako sa Davao!',
                'Friendly ang staff ug limpyo ang lugar.',
                'Medyo mahal pero worth it ang lasa.',
                'Kulang og asin pero okay ra overall.',
                'Perfect ni after class, barato ug lami.',
                'Dili na ko mubalik, bugnaw na ang sud-an.',
            ]),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}