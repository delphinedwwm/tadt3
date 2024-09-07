<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Answer;
use App\Models\User;
use App\Models\UserQuestion;
use App\Models\GameQuestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Cette classe défini le modèle Eloquent concernant pour la table 'movies'
 */

class Question extends Model
{
    use HasFactory;

     /**
     * Définit les champs assignables en masse
     * 
     * @var $fillable
     */
    protected $fillable = 
                [
                    'question', 
                    'level', 
                    'category_id', 
                    'user_id'
                ];

    /**
     * Définit la relation BelongsTo avec la table 'Categories'
     *      - Une catégorie (table 'Categories') concerne une ou plusieurs questions (table 'question') : défini dans le modèle 'Question'
     *      - Une question (table 'Questions') est concernée par une et une seule catégorie (table 'categories') : défini ici
     * 
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    /**
     * Définit la relation OneToMany avec la table 'Answers'
     *      - Une question (table 'Questions') concerne une ou plusieurs péronses (table 'Answer') : défini dans le modèle 'Answer'
     *      - Une réponse (table 'Answers') est concernée par une et une seule question (table 'Questions') : défini ici
     * 
     * @return BelongsTo
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

     /**
     * Définit la relation BelongsToMany avec la table 'users' :
     *      - Un user (table 'users') concerne zéro à plusieurs questions (table 'questions') : défini dans le modèle 'Genre'
     *      - Une question (table 'questions') est concernée par zéro à plusieurs user (table 'users') : défini ici
     * 
     * Cette relation génère donc une table pivot (ou table d'association) qui est 'users_questions'
     * Il y a donc la relation suivante avec la table 'users_questions'
     *      - Un user (table 'users') concerne zéro ou plusieurs association user/questions (table 'users_questions')
     *      - Une association user/questions (table 'users_questions') est concernée par un et un seul user (table 'users')
     * 
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_questions')
                    ->using(UserQuestion::class) // Indique le modèle de la table pivot
                    ->withPivot( 'user_id', 'question_id', 'asked_count', 'stars', 'answers_trues_count',)
            // Colonnes supplémentaires dans la table pivot
                    ->withTimestamps(); // Indique l'utilisation des dates de création et mise à jour dans la   table pivot
    }

    /**
     * Définit la relation BelongsToMany avec la table 'games' via la table pivot 'games_questions'
     *      - Un jeu (table 'games') concerne zéro à plusieurs questions (table 'questions') : défini dans le modèle 'Game'
     *      - Une question (table 'questions') est concernée par zéro à plusieurs jeux (table 'games') : défini ici
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
