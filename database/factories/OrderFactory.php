<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_email' => fake()->unique()->safeEmail(),
            'total_price' => rand(1500,3000),
            'purchased_on' => fake()->dateTimeBetween('-4 week', '-1 week'),
        ];
    }
}
