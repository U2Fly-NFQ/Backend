<?php

namespace App\Controller\Payment\Stripe;

use App\Constant\StripeConstant;
use App\Repository\TicketFlightRepository;
use App\Service\MailService;
use App\Service\PassengerService;
use App\Service\TicketFlightService;
use App\Service\TicketService;
use App\Traits\JsonTrait;
use App\Transformer\TicketTransformer;
use Exception;
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
    const PAYMENT_SUCCESS_TOPIC = "Your payment is successfully for";
    const PAYMENT_SUCCESS_BODY = "Your payment was ";
    use JsonTrait;

    /**
     * @throws ApiErrorException
     * @throws Exception
     */
    #[Route('/stripe/success', name: 'stripe_success')]
    public function index(
        Request $request,
        ParameterBagInterface $parameterBag,
        TicketService $ticketService,
        MailService $mailService,
        PassengerService $passengerService,
        TicketFlightService $ticketFlightService,
    ): RedirectResponse {
        Stripe::setApiKey($parameterBag->get('stripeSecret'));
        $session = Session::retrieve($request->get('session_id'));
        $sessionArray = $session->toArray();
        $ticket = $ticketService->addByArrayData($sessionArray['metadata'], $sessionArray['payment_intent']);
        $flights = explode(',', $sessionArray['metadata']['flightId']);
        $ticketFlightService->add($ticket, $flights, $ticket->getSeatType());
        $passenger = $passengerService->find($ticket->getPassenger());
        $accountEmail = $passenger->getAccount()->getEmail();
        $passengerName = $passenger->getName();

        $contain = [
            'topic' => self::PAYMENT_SUCCESS_TOPIC,
            'body' => self::PAYMENT_SUCCESS_BODY,
            'totalPrice' => $ticket->getTotalPrice()
        ];

        $mailService->mail($accountEmail,  $passengerName, $contain);

        return new RedirectResponse(StripeConstant::TARGET_URL . '/' . $ticket->getId());
    }
}
