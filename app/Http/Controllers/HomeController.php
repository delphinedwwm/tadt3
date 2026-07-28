<?php

namespace App\Http\Controllers;

use App\Services\Statistics\UserStatisticsService;
use App\Services\Statistics\AdminStatisticsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    private $adminStatisticsService;
    private $userStatisticsService;

    public function __construct(
        AdminStatisticsService $adminStatisticsService,
        UserStatisticsService $userStatisticsService
    ) {
        $this->middleware('auth');
        $this->adminStatisticsService = $adminStatisticsService;
        $this->userStatisticsService = $userStatisticsService;
    }

    /**
     * Affiche le dashboard avec les stats appropriées
     */
    public function showHome(): View
    {
        $user = Auth::user();
        $game = $user->game; // Partie en cours

        if ($user->hasRole('admin')) {
            // Admin voit les stats GLOBALES + ses stats PERSO
            $globalStats = $this->adminStatisticsService->getAllStatistics();
            $personalStats = $this->adminStatisticsService->getAdminPersonalStatistics();

            return view('home', [
                // ========== STATS GLOBALES (Onglet 1) ==========
                'questionsToday' => $globalStats['questionsToday'] ?? 0,
                'questionsThisWeek' => $globalStats['questionsThisWeek'] ?? 0,
                'questionsThisMonth' => $globalStats['questionsThisMonth'] ?? 0,
                'questionsThisYear' => $globalStats['questionsThisYear'] ?? 0,
                'questionsAllTime' => $globalStats['questionsAllTime'] ?? 0,

                'correctAnswersPercentageToday' => $globalStats['correctAnswersPercentageToday'] ?? 0,
                'correctAnswersPercentageThisWeek' => $globalStats['correctAnswersPercentageThisWeek'] ?? 0,
                'correctAnswersPercentageThisMonth' => $globalStats['correctAnswersPercentageThisMonth'] ?? 0,
                'correctAnswersPercentageThisYear' => $globalStats['correctAnswersPercentageThisYear'] ?? 0,
                'correctAnswersPercentageAllTime' => $globalStats['correctAnswersPercentageAllTime'] ?? 0,

                'newUsersToday' => $globalStats['newUsersToday'] ?? 0,
                'newUsersThisWeek' => $globalStats['newUsersThisWeek'] ?? 0,
                'newUsersThisMonth' => $globalStats['newUsersThisMonth'] ?? 0,
                'newUsersThisYear' => $globalStats['newUsersThisYear'] ?? 0,
                'newUsersAllTime' => $globalStats['newUsersAllTime'] ?? 0,

                'categoriesToday' => $globalStats['categoriesToday'] ?? collect(),
                'categoriesThisWeek' => $globalStats['categoriesThisWeek'] ?? collect(),
                'categoriesThisMonth' => $globalStats['categoriesThisMonth'] ?? collect(),
                'categoriesThisYear' => $globalStats['categoriesThisYear'] ?? collect(),
                'categoriesAllTime' => $globalStats['categoriesAllTime'] ?? collect(),

                // ========== STATS PERSO ADMIN (Onglet 2) ==========
                'personalQuestionsToday' => $personalStats['questionsToday'] ?? 0,
                'personalQuestionsThisWeek' => $personalStats['questionsThisWeek'] ?? 0,
                'personalQuestionsThisMonth' => $personalStats['questionsThisMonth'] ?? 0,
                'personalQuestionsThisYear' => $personalStats['questionsThisYear'] ?? 0,
                'personalQuestionsAllTime' => $personalStats['questionsAllTime'] ?? 0,

                'personalCorrectAnswersPercentageToday' => $personalStats['correctAnswersPercentageToday'] ?? 0,
                'personalCorrectAnswersPercentageThisWeek' => $personalStats['correctAnswersPercentageThisWeek'] ?? 0,
                'personalCorrectAnswersPercentageThisMonth' => $personalStats['correctAnswersPercentageThisMonth'] ?? 0,
                'personalCorrectAnswersPercentageThisYear' => $personalStats['correctAnswersPercentageThisYear'] ?? 0,
                'personalCorrectAnswersPercentageAllTime' => $personalStats['correctAnswersPercentageAllTime'] ?? 0,

                'personalCategoriesToday' => $personalStats['categoriesToday'] ?? collect(),
                'personalCategoriesThisWeek' => $personalStats['categoriesThisWeek'] ?? collect(),
                'personalCategoriesThisMonth' => $personalStats['categoriesThisMonth'] ?? collect(),
                'personalCategoriesThisYear' => $personalStats['categoriesThisYear'] ?? collect(),
                'personalCategoriesAllTime' => $personalStats['categoriesAllTime'] ?? collect(),

                // ========== AUTRES ==========
                'game' => $game,
                'isAdmin' => true
            ]);
        } else {
            // User voit uniquement ses stats PERSO
            $userStats = $this->userStatisticsService->getAllStatistics();

            return view('home', [
                // ========== STATS PERSO USER (Onglet 2) ==========
                'personalQuestionsToday' => $userStats['questionsToday'] ?? 0,
                'personalQuestionsThisWeek' => $userStats['questionsThisWeek'] ?? 0,
                'personalQuestionsThisMonth' => $userStats['questionsThisMonth'] ?? 0,
                'personalQuestionsThisYear' => $userStats['questionsThisYear'] ?? 0,
                'personalQuestionsAllTime' => $userStats['questionsAllTime'] ?? 0,

                'personalCorrectAnswersPercentageToday' => $userStats['correctAnswersPercentageToday'] ?? 0,
                'personalCorrectAnswersPercentageThisWeek' => $userStats['correctAnswersPercentageThisWeek'] ?? 0,
                'personalCorrectAnswersPercentageThisMonth' => $userStats['correctAnswersPercentageThisMonth'] ?? 0,
                'personalCorrectAnswersPercentageThisYear' => $userStats['correctAnswersPercentageThisYear'] ?? 0,
                'personalCorrectAnswersPercentageAllTime' => $userStats['correctAnswersPercentageAllTime'] ?? 0,

                'personalCategoriesToday' => $userStats['categoriesToday'] ?? collect(),
                'personalCategoriesThisWeek' => $userStats['categoriesThisWeek'] ?? collect(),
                'personalCategoriesThisMonth' => $userStats['categoriesThisMonth'] ?? collect(),
                'personalCategoriesThisYear' => $userStats['categoriesThisYear'] ?? collect(),
                'personalCategoriesAllTime' => $userStats['categoriesAllTime'] ?? collect(),

                // ========== AUTRES ==========
                'game' => $game,
                'isAdmin' => false
            ]);
        }
    }
}