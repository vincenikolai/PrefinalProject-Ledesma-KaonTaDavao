<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Eatery>
 */
class EateryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = fake()->randomElement(['Kainan ni', 'Lutong Bahay ni', 'Sugba ni', 'Panciteria ni', 'Ihaw-Ihaw ni']);
        $name = $prefix . ' ' . fake()->unique()->firstName();

        return [
            'district_id' => District::inRandomOrder()->first()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->streetName() . ', Davao City',
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement([
                'Tinolang Manok',
                'Kinilaw',
                'Sinugbang Panga',
                'Humba',
                'Pancit Bisaya',
                'Lechon Manok',
                'Bulalo',
                'Sinigang na Baboy',
                'Grilled Tuna Belly',
                'Durian Shake',
            ]),
            'is_open' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_open' => false,
        ]);
    }
}