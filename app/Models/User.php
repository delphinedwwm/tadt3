<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Définit la relation HasOne avec la table 'games'
     * - Un utilisateur a une partie active
     *
     * @return HasOne
     */
    public function game(): HasOne
    {
        return $this->hasOne(Game::class);
    }

    /**
     * Définit la relation avec la table 'questions' :
     * - Un utilisateur (table 'users') concerne zéro à plusieurs questions (table 'questions')
     * - Une question (table 'questions') est concernée par zéro à plusieurs utilisateurs (table 'users')
     *
     * Cette relation génère une table pivot 'user_question'.
     *
     * @return BelongsToMany
     */
    public function user_question(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'user_question')
                    ->using(UserQuestion::class)
                    ->withPivot('asked_count', 'stars', 'answers_trues_count')
                    ->withTimestamps();
    }
}