<?php

namespace App\Services\Game;

use App\Models\UserQuestion;
use Illuminate\Support\Facades\DB;

class UserQuestionService
{
    /**
     * Enregistre ou met à jour l'interaction d'un utilisateur avec une question
     * 
     * @param int $userId
     * @param int $questionId
     * @param bool $isCorrect
     * @return UserQuestion
     */
    public function recordInteraction(int $userId, int $questionId, bool $isCorrect): UserQuestion
    {
        $userQuestion = UserQuestion::firstOrNew([
            'user_id' => $userId,
            'question_id' => $questionId
        ]);

        $userQuestion->asked_count += 1;

        if ($isCorrect) {
            $userQuestion->answers_trues_count += 1;
        }

        $userQuestion->save();

        return $userQuestion;
    }

    /**
     * Récupère les statistiques d'un utilisateur pour une question
     * 
     * @param int $userId
     * @param int $questionId
     * @return UserQuestion|null
     */
    public function getQuestionStats(int $userId, int $questionId): ?UserQuestion
    {
        return UserQuestion::where('user_id', $userId)
            ->where('question_id', $questionId)
            ->first();
    }

    /**
     * Récupère toutes les statistiques d'un utilisateur
     * 
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserStats(int $userId)
    {
        return UserQuestion::where('user_id', $userId)->get();
    }

    /**
     * Calcule le pourcentage de bonnes réponses pour une question
     * (Vue admin : "combien de % de users ont réussi cette question")
     * 
     * @param int $questionId
     * @return float
     */
    public function getCorrectAnswerPercentage(int $questionId): float
    {
        $data = UserQuestion::where('question_id', $questionId)
            ->selectRaw('SUM(asked_count) as total_asked, SUM(answers_trues_count) as total_correct')
            ->first();

        if (!$data || $data->total_asked == 0) {
            return 0;
        }

        return round(($data->total_correct / $data->total_asked) * 100, 2);
    }

    /**
     * Récupère les stats globales d'un utilisateur
     * 
     * @param int $userId
     * @return array
     */
    public function getUserGlobalStats(int $userId): array
    {
        $userQuestions = UserQuestion::where('user_id', $userId)->get();

        $totalAsked = $userQuestions->sum('asked_count');
        $totalCorrect = $userQuestions->sum('answers_trues_count');

        return [
            'total_questions' => $userQuestions->count(),
            'total_asked' => $totalAsked,
            'total_correct' => $totalCorrect,
            'percentage' => $totalAsked > 0
                ? round(($totalCorrect / $totalAsked) * 100, 2)
                : 0,
        ];
    }

    /**
     * Récupère les stats par catégorie pour un utilisateur
     * 
     * @param int $userId
     * @return array
     */
    public function getUserStatsByCategory(int $userId): array
    {
        $userQuestions = UserQuestion::where('user_id', $userId)
            ->with('question.category')
            ->get();

        $stats = [];

        foreach ($userQuestions as $uq) {
            $categoryName = $uq->question->category->name;

            if (!isset($stats[$categoryName])) {
                $stats[$categoryName] = [
                    'total_asked' => 0,
                    'total_correct' => 0,
                ];
            }

            $stats[$categoryName]['total_asked'] += $uq->asked_count;
            $stats[$categoryName]['total_correct'] += $uq->answers_trues_count;
        }

        // Calculer pourcentages
        foreach ($stats as &$stat) {
            $stat['percentage'] = $stat['total_asked'] > 0
                ? round(($stat['total_correct'] / $stat['total_asked']) * 100, 2)
                : 0;
        }

        return $stats;
    }

    /**
     * Récupère les questions les plus difficiles pour un utilisateur
     * 
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMostDifficultQuestions(int $userId, int $limit = 5)
    {
        return UserQuestion::where('user_id', $userId)
            ->with('question')
            ->selectRaw('question_id, SUM(asked_count) as total_asked, SUM(answers_trues_count) as total_correct')
            ->groupBy('question_id')
            ->having('total_correct', '<', \DB::raw('total_asked / 2'))
            ->orderByRaw('(total_asked - total_correct) DESC')
            ->limit($limit)
            ->get();
    }
}