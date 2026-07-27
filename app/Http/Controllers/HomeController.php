<?php

namespace App\Http\Controllers;

use App\Services\Statistics\AdminStatisticsService;
use App\Services\Statistics\UserStatisticsService;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $user = Auth::user();
        $game = $user->game;

        // Vérifier le rôle de l'utilisateur
        if ($user->hasRole('admin')) {
            // Récupérer les stats ADMIN
            $statistics = $this->adminStatisticsService->getAllStatistics();
        } else {
            // Récupérer les stats USER
            $statistics = $this->userStatisticsService->getUserStatistics();
        }

        return view('home', array_merge($statistics, ['game' => $game]));
    }
}