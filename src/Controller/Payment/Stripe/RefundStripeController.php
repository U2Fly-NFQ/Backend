<?php

namespace App\Controller\Payment\Stripe;
use App\Request\RefundRequest;
use App\Service\StripeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payment', name: 'api_stripe_')]
class RefundStripeController
{
    #[Route('/stripe/refund', name: 'refund')]
    public function index(
        Request $request,
        RefundRequest $refundRequest,
        StripeService $stripeService
    )
    {
        $requestBody = json_decode($request->getContent(), true);
        $refundRequest = $refundRequest->fromArray($requestBody);
        $stripeService->refund($refundRequest);

    }
}
