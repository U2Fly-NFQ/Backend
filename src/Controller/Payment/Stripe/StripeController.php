<?php

namespace App\Controller\Payment\Stripe;

use App\Request\PaymentRequest;
use App\Service\StripeService;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payment', name: 'api_stripe_')]
class StripeController
{
    /**
     * @throws ApiErrorException
     */
    #[Route('/stripe', name: 'pay')]
    public function pay(
        StripeService $stripeService,
        Request $request,
        PaymentRequest $paymentRequest,
    )
    {
        $requestBody = json_decode($request->getContent(), true);
        $paymentRequest = $paymentRequest->fromArray($requestBody);
        return $stripeService->checkout($paymentRequest);
    }
}
