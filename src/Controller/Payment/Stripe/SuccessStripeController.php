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

#[Route('/api/payment', name: 'api_stripe_')]
class SuccessStripeController
{
    const FILE = __DIR__ . "/../../../../public/file/PaymentConfirm.html";
    use JsonTrait;


    /**
     * @throws ApiErrorException
     * @throws Exception
     */
    #[Route('/stripe/success', name: 'success')]
    public function index(Request               $request,
                          ParameterBagInterface $parameterBag,
                          TicketService         $ticketService,
                          MailService           $mailService,
                          PassengerService      $passengerService,
                          TicketFlightService   $ticketFlightService,
    ): RedirectResponse
    {

        Stripe::setApiKey($parameterBag->get('stripeSecret'));
        $session = Session::retrieve($request->get('session_id'));
        $sessionArray = $session->toArray();
        $ticket = $ticketService->addByArrayData($sessionArray['metadata']);
        $flights = explode(',', $sessionArray['metadata']['flightId']);
        $ticketFlightService->add($ticket, $flights, $ticket->getSeatType());
        $passenger = $passengerService->find($ticket->getPassenger());
        $accountEmail = $passenger->getAccount()->getEmail();
        $passengerName = $passenger->getName();
        $mailService->mail($accountEmail, self::FILE, $passengerName);

        return new RedirectResponse(StripeConstant::TARGET_URL . '/' . $ticket->getId());
    }
}
