<?php

namespace App\Controller\Payment\Stripe;

use App\Request\RefundRequest;
use App\Service\MailService;
use App\Service\PassengerService;
use App\Service\StripeService;
use App\Traits\JsonTrait;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payment', name: 'api_stripe_')]
class RefundStripeController
{
    const CANCEL_FILE = __DIR__ . "/../../../../public/file/PaymentCanceled.gif";
    const CANCEL_TOPIC = "Cancel successfully for";
    const CANCEL_BODY = "You have been refunded with ";
    const SENT_MESSAGE = "You have been refunded with ";

    use JsonTrait;

    /**
     * @throws Exception
     */
    #[Route('/stripe/refund', name: 'refund')]
    public function index(
        Request $request,
        RefundRequest $refundRequest,
        StripeService $stripeService,
        PassengerService $passengerService,
        MailService $mailService
    ): JsonResponse {
        $requestBody = json_decode($request->getContent(), true);
        $refundRequest = $refundRequest->fromArray($requestBody);
        $ticket = $stripeService->refund($refundRequest);

        $passenger = $passengerService->find($ticket->getPassenger());
        $accountEmail = $passenger->getAccount()->getEmail();
        $passengerName = $passenger->getName();

        $contain = [
            'topic' => self::CANCEL_TOPIC,
            'body' => self::CANCEL_BODY,
            'totalPrice' => $ticket->getTotalPrice()
        ];

        $mailService->mail($accountEmail, RefundStripeController::CANCEL_FILE, $passengerName, $contain);

        return $this->success([
            'message' => self::SENT_MESSAGE
        ]);
    }
}
