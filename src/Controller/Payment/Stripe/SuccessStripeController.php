<?php

namespace App\Controller\Payment\Stripe;

use App\Constant\StripeConstant;
use App\Event\BaseEvent;
use App\Event\MailerEvent;
use App\Service\TicketFlightService;
use App\Service\TicketService;
use App\Traits\JsonTrait;
use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class SuccessStripeController
{
    use JsonTrait;

    /**
     * @throws ApiErrorException
     * @throws Exception
     */
    #[Route('/stripe/success', name: 'stripe_success')]
    public function successPayment(
        Request $request,
        ParameterBagInterface $parameterBag,
        TicketService $ticketService,
        TicketFlightService $ticketFlightService,
        EventDispatcherInterface $eventDispatcher
    ): RedirectResponse {
        Stripe::setApiKey($parameterBag->get('stripeSecret'));
        $session = Session::retrieve($request->get('session_id'));
        $sessionArray = $session->toArray();
        $ticket = $ticketService->addByArrayData($sessionArray['metadata'], $sessionArray['payment_intent']);

        $flights = explode(',', $sessionArray['metadata']['flightId']);
        $ticketFlightService->add($ticket, $flights, $ticket->getSeatType());

        $mailerEvent = new MailerEvent($ticket);
        $eventDispatcher->dispatch($mailerEvent, 'event.successMail');
        $bookingEvent = new BaseEvent();
        $eventDispatcher->dispatch($bookingEvent, 'event.bookingSuccess');

        return new RedirectResponse($parameterBag->get('returnTicketUrl') . '/' . $ticket->getId());
    }
}
