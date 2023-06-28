<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stadium>
 */
class StadiumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->city();
        return [
            'stadium_name' => $city." Stadium",
            'located_on_city' => $city,
            'capacity' => random_int(30000,80000),
            'stadium_image_url' => fake()->imageUrl(),
        ];
    }
}
