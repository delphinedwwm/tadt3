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
class Games_questions extends Pivot
{
    use HasFactory;

    /**
     * Définit le nom de la table dans la BDD
     * 
     * @var $table
     */
    protected $table = 'games_questions';

    /**
     * Définit la relation OneToMany avec la table 'games' :
     *      - Un 'game' (table 'games') concerne zéro ou plusieurs association game/questions (table 'games_questions') : défini dans le modèle 'Game'
     *      - Une association game/question (table 'games_questions') est concernée par un et un seul game (table 'games') : défini ici
     * 
     * @return BelongsTo
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Définit la relation OneToMany avec la table 'questions' :
     *      - Une question (table 'questions') concerne zéro ou plusieurs association game_questions (table 'games_questions') : défini dans le modèle 'Question'
     *      - Une association game/question (table 'games_questions') est concernée par une et un seule question (table 'questions') : défini ici
     *
     * @return BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
