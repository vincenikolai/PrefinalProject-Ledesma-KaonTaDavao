<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permit>
 */
class PermitFactory extends Factory
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
            'permit_no' => 'DVO-' . fake()->numberBetween(2024, 2026) . '-' . fake()->unique()->numberBetween(10000, 99999),
            'expires_on' => fake()->dateTimeBetween('+1 month', '+2 years')->format('Y-m-d'),
        ];
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'expires_on' => fake()->dateTimeBetween('-1 year', '-1 week')->format('Y-m-d'),
        ]);
    }
}