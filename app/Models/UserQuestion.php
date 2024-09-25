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
class UserQuestion extends Pivot
{
    use HasFactory;
    protected $table = "userQuestion"; // Si le nom de la table est différent de la convention
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
     * Définit la relation OneToMany avec la table 'users' :
     *      
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
     *      - Une association user/question (table 'users_questions') est concernée par une et une seule question (table 'questions') : défini ici
     * 
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
