<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matchgame>
 */
class MatchgameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'played_on_date' => fake()->dateTimeThisMonth(),
            'played_on_time' => fake()->time('H:i'),
        ];
    }
}
