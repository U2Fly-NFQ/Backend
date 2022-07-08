<?php

namespace App\Service;

use App\Repository\DashboardRepository;

class DashboardService
{
    private DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardData()
    {
        $result = [];
        $result['top_route'] = $this->dashboardRepository->getAnalyzeOfRoute();
        $result['top_airline'] = $this->dashboardRepository->getAnalyzeOfAirline();

        return $result;
    }
}
