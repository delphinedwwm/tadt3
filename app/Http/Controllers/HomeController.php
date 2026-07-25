<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\AdminStatisticsService;
use App\Services\UserStatisticsService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Si c'est un admin, charge les stats globales
        if ($user->hasRole('admin')) {
            $adminService = new AdminStatisticsService();
            $data = $adminService->getAllStatistics();
            return view('home', $data);
        }

        // Sinon, charge les stats personnelles
        $userService = new UserStatisticsService();
        $data = $userService->getUserStatistics();
        return view('home', $data);
    }
}