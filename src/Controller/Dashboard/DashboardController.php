<?php

namespace App\Controller\Dashboard;

use App\Repository\DiscountRepository;
use App\Service\DashboardService;
use App\Traits\JsonTrait;
use App\Transformer\DiscountTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    use JsonTrait;

    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

//    #[IsGranted('ROLE_ADMIN', message: "GET OUT USER")]
    #[Route('/api/dashboard', name: 'app_dashboard', methods: 'GET')]
    public function getDashboard(): JsonResponse
    {
        $data = $this->dashboardService->getDashboardData();

        return $this->success($data);
    }
}
