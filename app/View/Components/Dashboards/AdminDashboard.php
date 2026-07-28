<?php

namespace App\View\Components\Dashboards;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Services\Statistics\AdminStatisticsService;

class AdminDashboard extends Component
{
    protected $adminStatisticsService;

    public function __construct(AdminStatisticsService $adminStatisticsService)
    {
        $this->adminStatisticsService = $adminStatisticsService;
    }

    public function render(): View
    {
        $stats = $this->adminStatisticsService->getAllStatistics();
        return view('components.dashboards.admin-dashboard', $stats);
    }
}