<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('123456'),
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Crée un utilisateur avec le rôle 'user'
     */
    public function withUserRole(): static
    {
        return $this->afterCreating(function (User $user) {
            $userRole = \Spatie\Permission\Models\Role::where('name', 'user')->first();
            if ($userRole) {
                $user->assignRole($userRole);
            }
        });
    }

    /**
     * Crée un utilisateur avec le rôle 'admin'
     */
    public function withAdminRole(): static
    {
        return $this->afterCreating(function (User $user) {
            $adminRole = \Spatie\Permission\Models\Role::where('name', 'admin')->first();
            if ($adminRole) {
                $user->assignRole($adminRole);
            }
        });
    }
}