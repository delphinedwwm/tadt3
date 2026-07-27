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
    )
    {
        $this->middleware('auth');
        $this->adminStatisticsService = $adminStatisticsService;
        $this->userStatisticsService = $userStatisticsService;
    }

    /**
     * Affiche le dashboard avec les statistiques appropriées
     */
    public function index(): View
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $stats = $this->adminStatisticsService->getAdminStatistics();
        } else {
            $stats = $this->userStatisticsService->getUserStatistics();
        }

        return view('statistics.dashboard', compact('stats', 'user'));
    }
}