<?php

namespace App\Controller;

use App\Request\PayPalRequest;
use App\Service\PayPalService;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class PayPalController
{
    #[Route('/paypal', name: 'paypal')]
    public function index(
        PayPalRequest $palRequest,
        PayPalService $palService,
    )
    {
        $apiContext=  $palService->config();
        $palRequest->set($apiContext);
    }
}
