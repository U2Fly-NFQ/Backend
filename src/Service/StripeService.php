<?php

namespace App\Service;

use App\Constant\StripeConstant;
use App\Request\PaymentRequest;
use Exception;
use Psr\Log\LoggerInterface;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StripeService
{
    const FILE = __DIR__ . "/../../../../public/file/PaymentConfirm.html";
    const CHECK_COMPLETED = 'checkout.session.completed';

    private ParameterBagInterface $params;
    private TicketService $ticketService;
    private TicketFlightService $ticketFlightService;
    private PassengerService $passengerService;
    private MailService $mailService;

    public function __construct(
        ParameterBagInterface $params,
        TicketService         $ticketService,
        TicketFlightService   $ticketFlightService,
        PassengerService      $passengerService,
        MailService           $mailService
    )
    {
        $this->params = $params;
        $this->ticketService = $ticketService;
        $this->ticketFlightService = $ticketFlightService;
        $this->passengerService = $passengerService;
        $this->mailService = $mailService;
    }

    /**
     * @throws ApiErrorException
     */
    public function getPayment(PaymentRequest $paymentRequest): Session
    {
        $stripeSK = $this->params->get('stripeSecret');
        Stripe::setApiKey($stripeSK);

        return Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'U2Fly_Ticket ' . $paymentRequest->getTicketOwner(),
                    ],
                    'unit_amount' => $paymentRequest->getTotalPrice(),
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                "passengerId" => $paymentRequest->getPassengerId(),
                "discountId" => $paymentRequest->getDiscountId(),
                "flightId" => $paymentRequest->getFlightId(),
                "seatTypeId" => $paymentRequest->getSeatTypeId(),
                "totalPrice" => $paymentRequest->getTotalPrice(),
                "ticketOwner" => $paymentRequest->getTicketOwner()
            ],
            'mode' => 'payment',

            'success_url' => StripeConstant::SUCCESS_URL,
            'cancel_url' => StripeConstant::FAILED_URL,
        ]);
    }

    /**
     * @throws Exception
     */
    public function eventHandler(mixed $data, mixed $type, mixed $metadata): RedirectResponse
    {
        if ($type === self::CHECK_COMPLETED) {
            $ticket = $this->ticketService->addByArrayData($metadata);
            $flights = explode(',', $metadata['flightId']);
            $this->ticketFlightService->add($ticket, $flights, $ticket->getSeatType());

            $passenger = $this->passengerService->find($ticket->getPassenger());
            $accountEmail = $passenger->getAccount()->getEmail();
            $passengerName = $passenger->getName();

            $this->mailService->mail($accountEmail, self::FILE, $passengerName);

            return new RedirectResponse(StripeConstant::TARGET_URL . '/' . $ticket->getId());
        }
    }
}
