<?php

namespace App\Controller\Payment\Stripe;

use App\Constant\StripeConstant;
use App\Event\BookingEvent;
use App\Event\MailerEvent;
use App\Request\RefundRequest;
use App\Service\StripeService;
use App\Traits\JsonTrait;
use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class RefundStripeController
{
    use JsonTrait;

    /**
     * @throws Exception
     */
    #[Route('/stripe/refund', name: 'stripe_refund', methods: 'POST')]
    public function refund(
        Request                  $request,
        RefundRequest            $refundRequest,
        StripeService            $stripeService,
        EventDispatcherInterface $eventDispatcher
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $refundRequest = $refundRequest->fromArray($requestBody);
        $ticket = $stripeService->refund($refundRequest);
        $mailerEvent = new MailerEvent($ticket);
        $eventDispatcher->dispatch($mailerEvent, 'event.refundMail');
        $bookingEvent = new BookingEvent();
        $eventDispatcher->dispatch($bookingEvent, 'event.bookingCancel');
        return $this->success([
            'message' => StripeConstant::CANCEL_COMPLETE_MESSAGE
        ]);
    }
}
