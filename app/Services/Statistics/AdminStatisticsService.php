<?php

namespace App\Services\Statistics;

use App\Services\Traits\CalculatesStatistics;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;

class AdminStatisticsService
{
    use CalculatesStatistics;

    public function getAllStatistics(): array
    {
        return [
            'categoriesToday' => $this->getCategoriesForPeriod('today'),
            'categoriesThisWeek' => $this->getCategoriesForPeriod('week'),
            'categoriesThisMonth' => $this->getCategoriesForPeriod('month'),
            'categoriesThisYear' => $this->getCategoriesForPeriod('year'),
            'categoriesAllTime' => $this->getCategoriesForPeriod('allTime'),

            // Sans userId = TOUS les utilisateurs
            'questionsToday' => $this->getQuestionsCountForPeriod('today', null),
            'questionsThisWeek' => $this->getQuestionsCountForPeriod('week', null),
            'questionsThisMonth' => $this->getQuestionsCountForPeriod('month', null),
            'questionsThisYear' => $this->getQuestionsCountForPeriod('year', null),
            'questionsAllTime' => $this->getQuestionsCountForPeriod('allTime', null),

            'correctAnswersPercentageToday' => $this->getCorrectAnswersPercentageForPeriod('today', null),
            'correctAnswersPercentageThisWeek' => $this->getCorrectAnswersPercentageForPeriod('week', null),
            'correctAnswersPercentageThisMonth' => $this->getCorrectAnswersPercentageForPeriod('month', null),
            'correctAnswersPercentageThisYear' => $this->getCorrectAnswersPercentageForPeriod('year', null),
            'correctAnswersPercentageAllTime' => $this->getCorrectAnswersPercentageForPeriod('allTime', null),

            'newUsersToday' => $this->getNewUsersCountForPeriod('today'),
            'newUsersThisWeek' => $this->getNewUsersCountForPeriod('week'),
            'newUsersThisMonth' => $this->getNewUsersCountForPeriod('month'),
            'newUsersThisYear' => $this->getNewUsersCountForPeriod('year'),
            'newUsersAllTime' => $this->getNewUsersCountForPeriod('allTime'),

            'randomQuestion' => Question::with('answers')->inRandomOrder()->first(),
        ];
    }

    /**
     * Récupère le nombre de nouveaux utilisateurs pour une période
     */
    private function getNewUsersCountForPeriod(string $period): int
    {
        $now = Carbon::now();
        $query = User::query();

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
            case 'allTime':
                // Pas de filtre
                break;
        }

        return $query->count();
    }
}