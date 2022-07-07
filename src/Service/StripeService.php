<?php

namespace App\Service;

use App\Constant\StripeConstant;
use App\Controller\Payment\Stripe\RefundStripeController;
use App\Entity\Ticket;
use App\Repository\PassengerRepository;
use App\Repository\TicketRepository;
use App\Request\RefundRequest;
use App\Request\StripePaymentRequest;
use App\Traits\JsonTrait;
use Exception;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;

class StripeService
{
    use JsonTrait;

    const CHECK_COMPLETED = 'checkout.session.completed';

    private ParameterBagInterface $parameterBag;
    private StripeClient $stripe;
    private TicketService $ticketService;
    private PassengerService $passengerService;
    private MailService $mailService;
    private TicketRepository $ticketRepository;
    private PassengerRepository $passengerRepository;

    public function __construct(
        ParameterBagInterface $params,
        TicketRepository $ticketRepository,
        TicketService $ticketService
    ) {
        $this->parameterBag = $params;
        $this->stripe = new StripeClient($this->parameterBag->get('stripeSecret'));
        $this->ticketRepository = $ticketRepository;
        $this->ticketService = $ticketService;
        $this->ticketFlightService = $ticketFlightService;
        $this->passengerService = $passengerService;
        $this->mailService = $mailService;
    }

    /**
     * @throws ApiErrorException
     */
    public function getPayment(StripePaymentRequest $paymentRequest): Session
    {
        $stripeSK = $this->parameterBag->get('stripeSecret');
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

            'success_url' => StripeConstant::SUCCESS_URL_LOCAL,
            'cancel_url' => StripeConstant::FAILED_URL,
        ]);
    }

    /**
     * @throws Exception
     */
    public function refund(RefundRequest $refundRequest): ?Ticket
    {
        $ticket = $this->ticketRepository->findOneBy(['paymentId' => $refundRequest->getPaymentId()]);
        $this->ticketService->cancel($ticket);

        $this->stripe->refunds->create([
            'payment_intent' => $refundRequest->getPaymentId(),
            'amount' => $ticket->getTotalPrice()
        ]);

        return $ticket;
    }
}
