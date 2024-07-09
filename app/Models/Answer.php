<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Cette classe défini le modèle Eloquent concernant pour la table 'Answers'
 */

class Answer extends Model
{
    use HasFactory;

    /**
     * Définit les champs assignables en masse
     * 
     * @var $fillable
     */
    protected $fillable = ['description', 'is_correct', 'question_id'];

     /**
     * Définit la relation BelongsTo avec la table 'questions'
     *      - Une réponse (table 'answers') est concernée par une et une seule question (table 'questions') : défini ici
     *      - Une question (table 'questions') concerne zéro ou plusieurs réponses (table 'answers') : défini dans le modèle 'Question'
     * 
     * @return BelongsTo
     */

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
