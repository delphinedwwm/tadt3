<?php

namespace App\Services\Statistics;

use Illuminate\Support\Facades\Auth;

class UserStatisticsService
{
    /**
     * Retourne TOUTES les stats personnelles de l'utilisateur
     */
    public function getAllStatistics()
    {
        return [
            'personalQuestionsToday' => $this->getUserQuestions('today'),
            'personalQuestionsThisWeek' => $this->getUserQuestions('week'),
            'personalQuestionsThisMonth' => $this->getUserQuestions('month'),
            'personalQuestionsThisYear' => $this->getUserQuestions('year'),
            'personalQuestionsAllTime' => $this->getUserQuestions('all'),
            
            'personalCorrectAnswersPercentageToday' => $this->getUserCorrectAnswersPercentage('today'),
            'personalCorrectAnswersPercentageThisWeek' => $this->getUserCorrectAnswersPercentage('week'),
            'personalCorrectAnswersPercentageThisMonth' => $this->getUserCorrectAnswersPercentage('month'),
            'personalCorrectAnswersPercentageThisYear' => $this->getUserCorrectAnswersPercentage('year'),
            'personalCorrectAnswersPercentageAllTime' => $this->getUserCorrectAnswersPercentage('all'),
            
            'personalCategoriesToday' => $this->getUserCategories('today'),
            'personalCategoriesThisWeek' => $this->getUserCategories('week'),
            'personalCategoriesThisMonth' => $this->getUserCategories('month'),
            'personalCategoriesThisYear' => $this->getUserCategories('year'),
            'personalCategoriesAllTime' => $this->getUserCategories('all'),
        ];
    }

    // ===== MÉTHODES PRIVÉES =====

    private function getUserQuestions($period)
    {
        return 0;
    }

    private function getUserCorrectAnswersPercentage($period)
    {
        return 0;
    }

    private function getUserCategories($period)
    {
        return collect();
    }
}