<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        ];
    }

    public function game() {
        return $this->hasOne(Game::class);
    }
    
     /**
     * Définit la relation avec la table 'questions' :
     * - Un utilisateur (table 'users') concerne zéro à plusieurs questions (table 'questions') : défini dans le modèle 'Genre'
     * - Une question (table 'questions') est concernée par zéro à plusieurs utilisateurs (table 'users') : défini ici
     *
     * Cette relation génère une table pivot (ou table d'association) qui est 'users_questions'.
     * Par conséquent, la relation suivante existe avec la table 'users_questions' :
     * - Un utilisateur (table 'users') concerne zéro ou plusieurs associations utilisateur/question (table 'users_questions')
     * - Une association utilisateur/question (table 'users_questions') concerne un et un seul utilisateur (table 'users')
     *
     * @return BelongsToMany
     */
    public function users_questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'users_questions')
                    ->using(UserQuestion::class) // Indique le modèle de la table pivot
                    ->withPivot('user_id', 'question_id', 'asked_count', 'stars', 'answers_trues_count') // Colonnes supplémentaires dans la table pivot
                    ->withTimestamps(); // Indique l'utilisation des dates de création et de mise à jour dans la table pivot
    }
}
