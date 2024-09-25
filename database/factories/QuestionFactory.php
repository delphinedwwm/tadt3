<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence(), // Contenu aléatoire de la question
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
