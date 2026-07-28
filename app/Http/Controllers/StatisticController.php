<?php

namespace App\Http\Controllers;

use App\Services\Statistics\AdminStatisticsService;
use App\Services\Statistics\UserStatisticsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StatisticController extends Controller
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
     * Affiche les statistiques appropriées selon le rôle
     */
    public function index(): View
    {
        $user = Auth::user();
        $game = $user->game;

        if ($user->hasRole('admin')) {
            // L'ADMIN a DEUX onglets
            $globalStats = $this->adminStatisticsService->getAllStatistics();
            $personalStats = $this->userStatisticsService->getAllStatistics();

            // Retourne la VUE ADMIN avec les DEUX services
            return view('components.dashboards.admin-dashboard', array_merge(
                $globalStats,
                $personalStats,
                ['game' => $game]
            ));
        } else {
            // 👤 L'USER a UN seul onglet
            $stats = $this->userStatisticsService->getAllStatistics();

            // Retourne la VUE USER avec le service USER
            return view('components.dashboards.user-dashboard', array_merge(
                $stats,
                ['game' => $game]
            ));
        }
    }
}