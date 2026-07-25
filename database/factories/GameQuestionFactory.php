<?php

namespace Database\Factories;

use App\Models\GameQuestion;
use App\Models\Game;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameQuestionFactory extends Factory
{
    protected $model = GameQuestion::class;

    public function definition(): array
    {
        return [
            'game_id' => null,  // Sera défini par ->for($user)
            'question_id' => Question::inRandomOrder()->first()?->id ?? 1,
            'asked_count' => $this->faker->numberBetween(1, 15),
            'answers_trues_count' => $this->faker->numberBetween(0, 15),
            'stars' => $this->faker->numberBetween(0, 5),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Configure la factory pour éviter les doublons
     */
    public function configure()
    {
        return $this->afterCreating(function (GameQuestion $gameQuestion) {
            // Supprime les doublons pour ce game_id + question_id
            GameQuestion::where('game_id', $gameQuestion->game_id)
                ->where('question_id', $gameQuestion->question_id)
                ->where('id', '!=', $gameQuestion->id)
                ->delete();
        });
    }
}