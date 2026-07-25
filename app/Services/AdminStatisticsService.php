<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;

class AdminStatisticsService
{
    /**
     * Récupère toutes les statistiques pour l'admin
     */
    public function getAllStatistics(): array
    {
        $now = Carbon::now();

        return [
            'categoriesToday' => $this->getCategoriesWithCountForPeriod('today'),
            'categoriesThisWeek' => $this->getCategoriesWithCountForPeriod('week'),
            'categoriesThisMonth' => $this->getCategoriesWithCountForPeriod('month'),
            'categoriesThisYear' => $this->getCategoriesWithCountForPeriod('year'),
            'categoriesAllTime' => $this->getCategoriesWithCountForPeriod('allTime'),
            
            'questionsToday' => $this->getQuestionsCountForPeriod('today'),
            'questionsThisWeek' => $this->getQuestionsCountForPeriod('week'),
            'questionsThisMonth' => $this->getQuestionsCountForPeriod('month'),
            'questionsThisYear' => $this->getQuestionsCountForPeriod('year'),
            'questionsAllTime' => $this->getQuestionsCountForPeriod('allTime'),
            
            'newUsersToday' => $this->getNewUsersCountForPeriod('today'),
            'newUsersThisWeek' => $this->getNewUsersCountForPeriod('week'),
            'newUsersThisMonth' => $this->getNewUsersCountForPeriod('month'),
            'newUsersThisYear' => $this->getNewUsersCountForPeriod('year'),
            'newUsersAllTime' => $this->getNewUsersCountForPeriod('allTime'),
        ];
    }

    /**
     * Récupère les catégories AVEC le count pour une période
     */
    private function getCategoriesWithCountForPeriod(string $period)
    {
        $now = Carbon::now();
        $query = Category::withCount(['questions' => function ($q) use ($now, $period) {
            $this->applyPeriodFilter($q, $period, $now);
        }]);

        return $query->orderBy('questions_count', 'desc')->get();
    }

    /**
     * Récupère le nombre de questions pour une période
     */
    private function getQuestionsCountForPeriod(string $period): int
    {
        return $this->getCountForPeriod(Question::class, $period);
    }

    /**
     * Récupère le nombre d'utilisateurs pour une période
     */
    private function getNewUsersCountForPeriod(string $period): int
    {
        return $this->getCountForPeriod(User::class, $period);
    }

    /**
     * Applique le filtre de période
     */
    private function applyPeriodFilter($query, string $period, Carbon $now)
    {
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
            case 'allTime':
                break;
        }
    }

    /**
     * Méthode générique pour récupérer le compte pour une période
     */
    private function getCountForPeriod(string $model, string $period): int
    {
        $now = Carbon::now();
        $query = $model::query();
        $this->applyPeriodFilter($query, $period, $now);
        return $query->count();
    }
}