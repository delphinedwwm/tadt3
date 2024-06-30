<?php

namespace App\Models;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Cette classe défini le modèle Eloquent concernant pour la table 'users_questions'
 * Cette table est la table pivot de la relation ManyToMany entre les tables 'users' et 'questions'
 */
class Users_questions extends Pivot
{
    use HasFactory;

    /**
     * Définit le nom de la table dans la BDD
     * 
     * @var $table
     */
    protected $table = 'users_questions';

    /**
     * Définit la relation OneToMany avec la table 'user' :
     *      - Un user (table 'users') concerne zéro ou plusieurs association users/questions (table 'users_questions') : défini dans le modèle 'User'
     *      - Une association user/question (table 'users_questions') est concernée par un et un seul user (table 'users') : défini ici
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Définit la relation OneToMany avec la table 'questions' :
     *      - Une question (table 'question') concerne zéro ou plusieurs association user/question (table 'users_questions') : défini dans le modèle 'Question'
     *      - Une association user/question (table 'users_questions') est concernée par une et une seule question (table 'questions') : défini ici
     *
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
