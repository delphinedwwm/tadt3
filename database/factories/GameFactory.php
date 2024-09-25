<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, 
            'score' => $this->faker->numberBetween(0, 100), 
            'completed_at' => $this->faker->dateTimeToday(),
            'completed_at' => $this->faker->dateTimeThisWeek(),
            'completed_at' => $this->faker->dateTimeThisMonth(),
            'completed_at' => $this->faker->dateTimeThisYear(),
            'completed_at' => $this->faker->dateTimeThisAllTime(),
        ];
    }
}
