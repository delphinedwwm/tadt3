<?php

namespace App\Models;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Cette classe défini le modèle Eloquent concernant pour la table 'games_questions'
 * Cette table est la table pivot de la relation ManyToMany entre les tables 'games' et 'questions'
 */
class GameQuestion extends Pivot
{
    use HasFactory;

     /**
     * Définit les champs assignables en masse
     * 
     * @var array $fillable
     */
    protected $fillable = 
                [
                    'user_id', 
                    'question_id', 
                    'asked_count', 
                    'stars', 
                    'answers_trues_count'
                ];

    /**
     * Définit la relation BelongsTo avec la table 'games' :
     *      - Une association game/question (table 'games_questions') est concernée par un et un seul game (table 'games') : défini ici
     * 
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Définit la relation BelongsTo avec la table 'questions' :
     *      - Une association game/question (table 'games_questions') est concernée par une et un seule question (table 'questions') : défini ici
     *
     * @return BelongsTo
     */
    public function BelongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
