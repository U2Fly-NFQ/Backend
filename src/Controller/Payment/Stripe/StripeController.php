<?php

namespace App\Controller\Payment\Stripe;

use App\Request\PaymentRequest;
use App\Service\StripeService;
use App\Traits\JsonTrait;
use Stripe\Exception\ApiErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payment', name: 'api_stripe_')]
class StripeController extends AbstractController
{

    use JsonTrait;

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
        $checkout = $stripeService->getPayment($paymentRequest);
        $formData = $stripeService->getFormRequest($paymentRequest);

        return $this->success(['checkoutURL' => $checkout->url]);
    }
}
