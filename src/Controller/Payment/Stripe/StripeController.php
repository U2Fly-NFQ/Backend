<?php

namespace App\Controller\Payment\Stripe;

use App\Request\StripePaymentRequest;
use App\Service\StripeService;
use App\Traits\JsonTrait;
use Stripe\Exception\ApiErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class StripeController extends AbstractController
{
    use JsonTrait;

    /**
     * @throws ApiErrorException
     */
    #[Route('/stripe', name: 'stripe_pay')]
    public function pay(
        StripeService $stripeService,
        Request $request,
        StripePaymentRequest $paymentRequest,
    ): JsonResponse {
        $requestBody = json_decode($request->getContent(), true);
        $paymentRequest = $paymentRequest->fromArray($requestBody);
        $checkout = $stripeService->getPayment($paymentRequest);

        return $this->success(['checkoutURL' => $checkout->url]);
    }
}
