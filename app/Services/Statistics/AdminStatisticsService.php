<?php

namespace App\Services\Statistics;

use App\Services\Traits\CalculatesStatistics;
use Illuminate\Support\Facades\Auth;

class AdminStatisticsService
{
    use CalculatesStatistics;

    /**
     * Retourne TOUTES les stats : globales (application) + perso de l'admin
     */
    public function getAllStatistics(): array
    {
        $adminId = Auth::id();

        return [
            // ===== STATS GLOBALES (toute l'application) =====
            'questionsToday' => $this->getQuestionsCountForPeriod('today'),
            'questionsThisWeek' => $this->getQuestionsCountForPeriod('week'),
            'questionsThisMonth' => $this->getQuestionsCountForPeriod('month'),
            'questionsThisYear' => $this->getQuestionsCountForPeriod('year'),
            'questionsAllTime' => $this->getQuestionsCountForPeriod('allTime'),

            'correctAnswersPercentageToday' => $this->getCorrectAnswersPercentageForPeriod('today'),
            'correctAnswersPercentageThisWeek' => $this->getCorrectAnswersPercentageForPeriod('week'),
            'correctAnswersPercentageThisMonth' => $this->getCorrectAnswersPercentageForPeriod('month'),
            'correctAnswersPercentageThisYear' => $this->getCorrectAnswersPercentageForPeriod('year'),
            'correctAnswersPercentageAllTime' => $this->getCorrectAnswersPercentageForPeriod('allTime'),

            'newUsersToday' => $this->getNewUsersCountForPeriod('today'),
            'newUsersThisWeek' => $this->getNewUsersCountForPeriod('week'),
            'newUsersThisMonth' => $this->getNewUsersCountForPeriod('month'),
            'newUsersThisYear' => $this->getNewUsersCountForPeriod('year'),
            'newUsersAllTime' => $this->getNewUsersCountForPeriod('allTime'),

            'categoriesToday' => $this->getCategoriesForPeriod('today'),
            'categoriesThisWeek' => $this->getCategoriesForPeriod('week'),
            'categoriesThisMonth' => $this->getCategoriesForPeriod('month'),
            'categoriesThisYear' => $this->getCategoriesForPeriod('year'),
            'categoriesAllTime' => $this->getCategoriesForPeriod('allTime'),

            // ===== STATS PERSO DE L'ADMIN (en tant que joueur) =====
            'personalQuestionsToday' => $this->getQuestionsCountForPeriodByUser($adminId, 'today'),
            'personalQuestionsThisWeek' => $this->getQuestionsCountForPeriodByUser($adminId, 'week'),
            'personalQuestionsThisMonth' => $this->getQuestionsCountForPeriodByUser($adminId, 'month'),
            'personalQuestionsThisYear' => $this->getQuestionsCountForPeriodByUser($adminId, 'year'),
            'personalQuestionsAllTime' => $this->getQuestionsCountForPeriodByUser($adminId, 'allTime'),

            'personalCorrectAnswersPercentageToday' => $this->getCorrectAnswersPercentageForPeriodByUser($adminId, 'today'),
            'personalCorrectAnswersPercentageThisWeek' => $this->getCorrectAnswersPercentageForPeriodByUser($adminId, 'week'),
            'personalCorrectAnswersPercentageThisMonth' => $this->getCorrectAnswersPercentageForPeriodByUser($adminId, 'month'),
            'personalCorrectAnswersPercentageThisYear' => $this->getCorrectAnswersPercentageForPeriodByUser($adminId, 'year'),
            'personalCorrectAnswersPercentageAllTime' => $this->getCorrectAnswersPercentageForPeriodByUser($adminId, 'allTime'),

            'personalCategoriesToday' => $this->getCategoriesForPeriodByUser($adminId, 'today'),
            'personalCategoriesThisWeek' => $this->getCategoriesForPeriodByUser($adminId, 'week'),
            'personalCategoriesThisMonth' => $this->getCategoriesForPeriodByUser($adminId, 'month'),
            'personalCategoriesThisYear' => $this->getCategoriesForPeriodByUser($adminId, 'year'),
            'personalCategoriesAllTime' => $this->getCategoriesForPeriodByUser($adminId, 'allTime'),
        ];
    }
}