<?php

namespace App\Services\Statistics;

use App\Models\Game;
use App\Models\GameQuestion;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserStatisticsService
{
    protected $userId;

    public function __construct()
    {
        $this->userId = Auth::id();
    }

    /**
     * Récupère toutes les statistiques personnelles de l'utilisateur
     */
    public function getUserStatistics()
    {
        return [
            // Catégories maîtrisées par période
            'categoriesToday' => $this->getCategoriesByPeriod('today'),
            'categoriesThisWeek' => $this->getCategoriesByPeriod('week'),
            'categoriesThisMonth' => $this->getCategoriesByPeriod('month'),
            'categoriesThisYear' => $this->getCategoriesByPeriod('year'),
            'categoriesAllTime' => $this->getCategoriesByPeriod('all'),

            // Questions répondues par période
            'questionsToday' => $this->getQuestionsCountByPeriod('today'),
            'questionsThisWeek' => $this->getQuestionsCountByPeriod('week'),
            'questionsThisMonth' => $this->getQuestionsCountByPeriod('month'),
            'questionsThisYear' => $this->getQuestionsCountByPeriod('year'),
            'questionsAllTime' => $this->getQuestionsCountByPeriod('all'),

            // Pourcentage de bonnes réponses par période
            'correctAnswersPercentageToday' => $this->getCorrectAnswersPercentage('today'),
            'correctAnswersPercentageThisWeek' => $this->getCorrectAnswersPercentage('week'),
            'correctAnswersPercentageThisMonth' => $this->getCorrectAnswersPercentage('month'),
            'correctAnswersPercentageThisYear' => $this->getCorrectAnswersPercentage('year'),
            'correctAnswersPercentageAllTime' => $this->getCorrectAnswersPercentage('all'),

            // Parties précédentes
            'userGames' => $this->getCompletedGames(),
        ];
    }

    /**
     * Récupère les catégories maîtrisées par période
     * Via les GameQuestion de l'utilisateur
     */
    private function getCategoriesByPeriod($period)
    {
        // D'abord, récupère les IDs des games de l'utilisateur
        $userGameIds = Game::where('user_id', $this->userId)
            ->pluck('id');

        // Puis récupère les catégories via les questions des games
        $query = Category::withCount([
            'questions' => function ($q) use ($userGameIds, $period) {
                $q->whereIn('id', function ($subQuery) use ($userGameIds) {
                    $subQuery->select('question_id')
                        ->from('game_question')
                        ->whereIn('game_id', $userGameIds);
                });
                
                $this->applyPeriodFilter($q, $period);
            }
        ]);

        return $query->orderBy('questions_count', 'desc')->get();
    }

    /**
     * Récupère le nombre de questions répondues par période
     * Via les GameQuestion de l'utilisateur
     */
    private function getQuestionsCountByPeriod($period)
    {
        // Récupère les IDs des games de l'utilisateur
        $userGameIds = Game::where('user_id', $this->userId)
            ->pluck('id');

        $query = GameQuestion::whereIn('game_id', $userGameIds);
        $this->applyPeriodFilter($query, $period);

        return $query->count();
    }

    /**
     * Récupère le pourcentage de bonnes réponses par période
     * Via les GameQuestion de l'utilisateur
     */
    private function getCorrectAnswersPercentage($period)
    {
        // Récupère les IDs des games de l'utilisateur
        $userGameIds = Game::where('user_id', $this->userId)
            ->pluck('id');

        $query = GameQuestion::whereIn('game_id', $userGameIds);
        $this->applyPeriodFilter($query, $period);

        $totalQuestions = (clone $query)->count();
        
        if ($totalQuestions === 0) {
            return 0;
        }

        // Compte les bonnes réponses (answers_trues_count > 0)
        $correctAnswers = (clone $query)
            ->where('answers_trues_count', '>', 0)
            ->count();

        return round(($correctAnswers / $totalQuestions) * 100, 2);
    }

    /**
     * Récupère les parties terminées de l'utilisateur
     */
    private function getCompletedGames()
    {
        return Game::where('user_id', $this->userId)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Applique le filtre de période à la requête
     */
    private function applyPeriodFilter(&$query, $period)
    {
        $now = Carbon::now();

        switch ($period) {
            case 'today':
                $query->whereDate('created_at', $now->toDateString());
                break;
            case 'week':
                $query->whereBetween('created_at', [
                    $now->copy()->startOfWeek(),
                    $now->copy()->endOfWeek()
                ]);
                break;
            case 'month':
                $query->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year);
                break;
            case 'year':
                $query->whereYear('created_at', $now->year);
                break;
            // case 'all' : pas de filtre
        }
    }
}