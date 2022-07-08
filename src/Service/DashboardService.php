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
        $result['flightAnalyze']['flightTotal'] = $this->dashboardRepository->getAnalyzeOfTotalFlight();
        $result['flightAnalyze']['flightSuccess'] = $this->dashboardRepository->getAnalyzeOfSuccessFlight();
        $result['flightAnalyze']['flightCancel'] = $this->dashboardRepository->getAnalyzeOfCancelFlight();


        return $result;
    }
}
