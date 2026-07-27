<?php

namespace App\Services\Game;

use App\Models\GameQuestion;

class GameQuestionService
{
    /**
     * Enregistre l'interaction avec une question dans une partie
     * 
     * @param int $gameId
     * @param int $questionId
     * @param bool $isCorrect
     * @return GameQuestion
     */
    public function recordInteraction(int $gameId, int $questionId, bool $isCorrect): GameQuestion
    {
        $gameQuestion = GameQuestion::firstOrNew([
            'game_id' => $gameId,
            'question_id' => $questionId
        ]);

        $gameQuestion->asked_count += 1;

        if ($isCorrect) {
            $gameQuestion->answers_trues_count += 1;
        }

        $gameQuestion->save();

        return $gameQuestion;
    }

    /**
     * Récupère les statistiques pour une question dans une partie
     * 
     * @param int $gameId
     * @param int $questionId
     * @return GameQuestion|null
     */
    public function getQuestionStats(int $gameId, int $questionId): ?GameQuestion
    {
        return GameQuestion::where('game_id', $gameId)
            ->where('question_id', $questionId)
            ->first();
    }

    /**
     * Récupère toutes les questions d'une partie
     * 
     * @param int $gameId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGameQuestions(int $gameId)
    {
        return GameQuestion::where('game_id', $gameId)->get();
    }

    /**
     * Compte le nombre de questions répondues dans une partie
     * 
     * @param int $gameId
     * @return int
     */
    public function getAnsweredQuestionsCount(int $gameId): int
    {
        return GameQuestion::where('game_id', $gameId)
            ->where('asked_count', '>', 0)
            ->count();
    }

    /**
     * Calcule le score total pour une partie
     * 
     * @param int $gameId
     * @return int
     */
    public function calculateGameScore(int $gameId): int
    {
        return GameQuestion::where('game_id', $gameId)
            ->sum('answers_trues_count');
    }

    /**
     * Calcule le pourcentage de bonnes réponses pour une partie
     * 
     * @param int $gameId
     * @return float
     */
    public function calculateGamePercentage(int $gameId): float
    {
        $totalAnswers = GameQuestion::where('game_id', $gameId)
            ->sum('asked_count');

        if ($totalAnswers === 0) {
            return 0;
        }

        $correctAnswers = GameQuestion::where('game_id', $gameId)
            ->sum('answers_trues_count');

        return round(($correctAnswers / $totalAnswers) * 100, 2);
    }

    /**
     * Récupère les stats par catégorie pour une partie
     * 
     * @param int $gameId
     * @return array
     */
    public function getStatsByCategory(int $gameId): array
    {
        $gameQuestions = GameQuestion::where('game_id', $gameId)
            ->with('question.category')
            ->get();

        $stats = [];

        foreach ($gameQuestions as $gq) {
            $categoryName = $gq->question->category->name;

            if (!isset($stats[$categoryName])) {
                $stats[$categoryName] = [
                    'total_asked' => 0,
                    'total_correct' => 0,
                ];
            }

            $stats[$categoryName]['total_asked'] += $gq->asked_count;
            $stats[$categoryName]['total_correct'] += $gq->answers_trues_count;
        }

        // Calculer pourcentages
        foreach ($stats as &$stat) {
            $stat['percentage'] = $stat['total_asked'] > 0
                ? round(($stat['total_correct'] / $stat['total_asked']) * 100, 2)
                : 0;
        }

        return $stats;
    }
}