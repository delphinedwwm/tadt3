<?php

namespace App\Http\Controllers;

use App\Services\AdminStatisticsService;
use App\Services\UserStatisticsService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use HasRoles;
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
            return view('home.admin', $data);
        }

        // Sinon, charge les stats personnelles
        $userService = new UserStatisticsService();
        $data = $userService->getUserStatistics();
        return view('home.user', $data);
    }
}