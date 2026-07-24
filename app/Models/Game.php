<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Cette classe défini le modèle Eloquent concernant la table 'games'
 */
class Game extends Model
{
    use HasFactory;

    const STATUS_PAUSED = 'paused';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'total_score',
        'points',
        'current_streak',
        'status',
        'started_at',
        'paused_at',
        'ended_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Définit la relation ManyToMany avec la table 'questions' via la table pivot 'game_question'
     *
     * @return BelongsToMany
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'game_question')
                    ->using(GameQuestion::class)
                    ->withPivot('asked_count', 'stars', 'answers_trues_count')
                    ->withTimestamps();
    }

    /**
     * Définit la relation HasMany avec la table pivot 'game_question'
     *
     * @return HasMany
     */
    public function gameQuestions(): HasMany
{
    return $this->hasMany(GameQuestion::class, 'game_id');
}
}