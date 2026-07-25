<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class GameFactory extends Factory
{
    protected $model = Game::class;

    /**
     * Define the model's default state.
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = Carbon::instance($startDate)->addHours($this->faker->numberBetween(1, 5));

        return [
            'user_id' => User::factory(),
            'total_score' => $this->faker->numberBetween(0, 500),
            'current_streak' => $this->faker->numberBetween(0, 15),
            'status' => $this->faker->randomElement(['in_progress', 'paused', 'completed']),
            'started_at' => $startDate,
            'paused_at' => $this->faker->boolean(30) ? Carbon::instance($startDate)->addHours(1) : null,
            'ended_at' => $endDate,
            'created_at' => $startDate,
            'updated_at' => $endDate,
        ];
    }

    /**
     * State pour une partie en cours
     */
    public function inProgress(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in_progress',
                'ended_at' => null,
                'paused_at' => null,
            ];
        });
    }

    /**
     * State pour une partie terminée
     */
    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'ended_at' => now(),
            ];
        });
    }
}