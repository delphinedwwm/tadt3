<?php

namespace App\Services\Traits;

use App\Models\Category;
use App\Models\GameQuestion;
use App\Models\Question;
use App\Models\UserQuestion;
use Carbon\Carbon;

trait CalculatesStatistics
{
    /**
     * Récupère les catégories pour une période (avec le nombre de questions)
     */
    protected function getCategoriesForPeriod(string $period): array
    {
        $now = Carbon::now();
        $query = Category::withCount('questions');

        switch ($period) {
            case 'today':
                $query->whereDate('created_at', $now->toDateString());
                break;
            case 'week':
                $query->whereBetween('created_at', [
                    $now->startOfWeek(),
                    $now->endOfWeek()
                ]);
                break;
            case 'month':
                $query->whereMonth('created_at', $now->month)
                      ->whereYear('created_at', $now->year);
                break;
            case 'year':
                $query->whereYear('created_at', $now->year);
                break;
            case 'all':
            case 'allTime':
                // Pas de filtre, on récupère tout
                break;
        }

        return $query->orderBy('questions_count', 'desc')->get()->toArray();
    }

    /**
     * Récupère le nombre de questions répondues par l'utilisateur pour une période
     */
    protected function getQuestionsCountForPeriod(string $period, ?int $userId = null): int
    {
        $now = Carbon::now();
        $query = UserQuestion::query();

        // Si userId est fourni, filtrer par cet utilisateur
        if ($userId) {
            $query->where('user_id', $userId);
        }

        switch ($period) {
            case 'today':
                $query->whereDate('created_at', $now->toDateString());
                break;
            case 'week':
                $query->whereBetween('created_at', [
                    $now->startOfWeek(),
                    $now->endOfWeek()
                ]);
                break;
            case 'month':
                $query->whereMonth('created_at', $now->month)
                      ->whereYear('created_at', $now->year);
                break;
            case 'year':
                $query->whereYear('created_at', $now->year);
                break;
            case 'all':
            case 'allTime':
                // Pas de filtre
                break;
        }

        return $query->count();
    }

    /**
     * Calcule le pourcentage de bonnes réponses pour une période
     */
    protected function getCorrectAnswersPercentageForPeriod(string $period, ?int $userId = null): float
    {
        $now = Carbon::now();
        $query = UserQuestion::query();

        if ($userId) {
            $query->where('user_id', $userId);
        }

        switch ($period) {
            case 'today':
                $query->whereDate('created_at', $now->toDateString());
                break;
            case 'week':
                $query->whereBetween('created_at', [
                    $now->startOfWeek(),
                    $now->endOfWeek()
                ]);
                break;
            case 'month':
                $query->whereMonth('created_at', $now->month)
                      ->whereYear('created_at', $now->year);
                break;
            case 'year':
                $query->whereYear('created_at', $now->year);
                break;
            case 'all':
            case 'allTime':
                // Pas de filtre
                break;
        }

        $total = $query->count();
        if ($total === 0) {
            return 0;
        }

        $correct = (clone $query)->sum('answers_trues_count');
        return round(($correct / $total) * 100, 2);
    }

    /**
     * Récupère les statistiques d'une question spécifique
     */
    protected function getQuestionStatistics(int $questionId, ?int $userId = null): array
    {
        $query = UserQuestion::where('question_id', $questionId);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $stats = $query->first();

        if (!$stats) {
            return [
                'asked_count' => 0,
                'correct_answers' => 0,
                'percentage' => 0,
                'stars' => 0,
            ];
        }

        return [
            'asked_count' => $stats->asked_count,
            'correct_answers' => $stats->answers_trues_count,
            'percentage' => $stats->asked_count > 0 
                ? round(($stats->answers_trues_count / $stats->asked_count) * 100, 2)
                : 0,
            'stars' => $stats->stars,
        ];
    }
}