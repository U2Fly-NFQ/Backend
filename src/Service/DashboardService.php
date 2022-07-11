<?php

namespace App\Service;

use App\Repository\DashboardRepository;
use App\Repository\TicketsStatisticRepository;
use App\Transformer\TicketStatisticTransformer;

class DashboardService
{
    private DashboardRepository $dashboardRepository;
    private TicketsStatisticRepository $ticketsStatisticRepository;
    private TicketStatisticTransformer $ticketStatisticTransformer;

    public function __construct(DashboardRepository $dashboardRepository, TicketsStatisticRepository $ticketsStatisticRepository, TicketStatisticTransformer $ticketStatisticTransformer)
    {
        $this->dashboardRepository = $dashboardRepository;
        $this->ticketsStatisticRepository = $ticketsStatisticRepository;
        $this->ticketStatisticTransformer = $ticketStatisticTransformer;
    }

    public function getDashboardData()
    {
        $result = [];
        $resultSuccess = [];
        $result['top_route'] = $this->dashboardRepository->getAnalyzeOfRoute();
        $result['top_airline'] = $this->dashboardRepository->getAnalyzeOfAirline();
        $tiketStatistic = $this->ticketsStatisticRepository->findAll();
        $tiketStatisticTransformer = $this->ticketStatisticTransformer->toArrayList($tiketStatistic);
        foreach ($tiketStatisticTransformer as $ticketStatistic) {
            $result['flightAnalyze']['flightOfDay'][] = $ticketStatistic;
        }

        return $result;
    }
}
