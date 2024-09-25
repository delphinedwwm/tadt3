<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Cette classe défini le modèle Eloquent concernant la table 'games'
 */
class Game extends Model
{
    use HasFactory;
    
    const STATUS_PAUSED = 'paused';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    /**
     * Définit les champs assignables en masse
     * 
     * @var array $fillable
     */
    
    // Indique que 'user_id' est la clé primaire
    protected $primaryKey = 'user_id';

    // Désactive l'auto-incrémentation, car la clé primaire n'est pas auto-incrémentée
    public $incrementing = false;

    // Indique que la clé primaire est de type entier
    protected $keyType = 'unsignedBigInteger';
    protected $fillable = ['user_id', 'points'];

    /**
     * Définit la relation BelongsTo avec la table 'users'
     *      - Un jeu (table 'game') est concerné par un et un seul utilisateur (table 'user'): défini ici
     *      - Un utilisateur (table 'user') concerne zéro ou plusieurs jeux (table 'game') : défini dans le modèle 'User'
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Définit la relation ManyToMany avec la table 'questions' via la table pivot 'games_questions'
     * 
     * @return BelongsToMany
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'games_questions')
                    ->using(GameQuestion::class) // Indique le modèle de la table pivot
                    ->withPivot( 'user_id', 'question_id', 'asked_count', 'stars', 'answers_trues_count',) // Colonnes supplémentaires dans la table pivot
                    ->withTimestamps(); // Indique l'utilisation des dates de création et mise à jour dans la table pivot
    }
}
