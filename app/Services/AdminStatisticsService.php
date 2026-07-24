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
     * @return array - Les statistiques
     */
    public function getAllStatistics(): array
    {
        $now = Carbon::now();

        return [
            'categories' => [
                'today' => $this->getCategoriesForPeriod('today'),
                'week' => $this->getCategoriesForPeriod('week'),
                'month' => $this->getCategoriesForPeriod('month'),
                'year' => $this->getCategoriesForPeriod('year'),
                'allTime' => $this->getCategoriesForPeriod('allTime'),
            ],
            'questions' => [
                'today' => $this->getQuestionsCountForPeriod('today'),
                'week' => $this->getQuestionsCountForPeriod('week'),
                'month' => $this->getQuestionsCountForPeriod('month'),
                'year' => $this->getQuestionsCountForPeriod('year'),
                'allTime' => $this->getQuestionsCountForPeriod('allTime'),
            ],
            'users' => [
                'today' => $this->getNewUsersCountForPeriod('today'),
                'week' => $this->getNewUsersCountForPeriod('week'),
                'month' => $this->getNewUsersCountForPeriod('month'),
                'year' => $this->getNewUsersCountForPeriod('year'),
                'allTime' => $this->getNewUsersCountForPeriod('allTime'),
            ],
        ];
    }

    /**
     * Récupère le nombre de catégories pour une période
     */
    private function getCategoriesForPeriod(string $period): int
    {
        return $this->getCountForPeriod(Category::class, $period);
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
     * Méthode générique pour récupérer le compte pour une période
     */
    private function getCountForPeriod(string $model, string $period): int
    {
        $now = Carbon::now();
        $query = $model::query();

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