<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamPlayingMatch>
 */
class TeamPlayingMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $condition_posibilities = ['home','away'];
        return [
            'condition' => $condition_posibilities[rand(0,1)],
        ];
    }
}
