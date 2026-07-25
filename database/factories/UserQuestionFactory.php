<?php

namespace Database\Factories;

use App\Models\UserQuestion;
use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserQuestionFactory extends Factory
{
    protected $model = UserQuestion::class;

    public function definition(): array
    {
        $question = Question::inRandomOrder()->first();
        if (!$question) {
            $question = Question::factory()->create();
        }

        $user = User::inRandomOrder()->first();
        if (!$user) {
            $user = User::factory()->create();
        }

        $askedCount = $this->faker->numberBetween(1, 20);
        $answeredCorrectly = $this->faker->numberBetween(0, $askedCount);

        return [
            'user_id' => $user->id,
            'question_id' => $question->id,
            'asked_count' => $askedCount,
            'answers_trues_count' => $answeredCorrectly,
            'stars' => $answeredCorrectly > 0 ? $this->faker->numberBetween(1, 5) : 0,
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }

    public function mostlyCorrect(): static
    {
        return $this->state(function (array $attributes) {
            $askedCount = $attributes['asked_count'];
            return [
                'answers_trues_count' => (int) ($askedCount * 0.8),
                'stars' => 5,
            ];
        });
    }

    public function mostlyWrong(): static
    {
        return $this->state(function (array $attributes) {
            $askedCount = $attributes['asked_count'];
            return [
                'answers_trues_count' => (int) ($askedCount * 0.2),
                'stars' => 1,
            ];
        });
    }
}