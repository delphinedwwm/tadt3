<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Cette classe défini le modèle Eloquent concernant la table 'game_question'
 * Cette table est la table pivot de la relation ManyToMany entre les tables 'games' et 'questions'
 */
class GameQuestion extends Pivot
{
    use HasFactory;

    /**
     * Nom explicite de la table, car elle ne suit pas la convention Laravel
     * (Laravel attendrait 'game_question' par défaut)
     *
     * @var string
     */
    protected $table = 'game_question';

    /**
     * Indique que la clé primaire s'auto-incrémente normalement
     * (nécessaire ici uniquement car la classe hérite de Pivot,
     * qui désactive l'auto-incrémentation par défaut)
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Définit les champs assignables en masse
     *
     * @var array $fillable
     */
    protected $fillable = [
        'game_id',
        'question_id',
        'asked_count',
        'stars',
        'answers_trues_count'
    ];

    /**
     * Définit la relation BelongsTo avec la table 'games' :
     *      - Une association game/question (table 'game_question') est concernée par un et un seul game (table 'games') : défini ici
     *
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Définit la relation BelongsTo avec la table 'questions' :
     *      - Une association game/question (table 'game_question') est concernée par une et une seule question (table 'questions') : défini ici
     *
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}