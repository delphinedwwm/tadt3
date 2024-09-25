<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserQuestionFactory extends Factory
{
    protected $model = UserQuestion::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Créer ou associer un utilisateur
            'question_id' => Question::factory(), // Créer ou associer une question
            'asked_count' => $this->faker->numberBetween(1, 10), // Nombre de fois que la question a été posée
            'answers_trues_count' => $this->faker->numberBetween(0, 5), // Nombre de réponses correctes
            'stars' => $this->faker->numberBetween(0, 5), // Système de notation des parties, si applicable
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Dates aléatoires sur la dernière année
        ];
    }
}