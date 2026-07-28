<?php

namespace App\View\Components\Dashboards;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Services\Statistics\UserStatisticsService;

class UserDashboard extends Component
{
    protected $userStatisticsService;

    public function __construct(UserStatisticsService $userStatisticsService)
    {
        $this->userStatisticsService = $userStatisticsService;
    }

    public function render(): View
    {
        $stats = $this->userStatisticsService->getAllStatistics();
        return view('components.dashboards.user-dashboard', $stats);
    }
}