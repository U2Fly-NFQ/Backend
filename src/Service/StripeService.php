<?php

namespace App\Service;

use App\Constant\StripeConstant;
use App\Entity\Ticket;
use App\Repository\TicketRepository;
use App\Request\PaymentRequest;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StripeService
{
    const CHECK_COMPLETED = 'checkout.session.completed';

    private ParameterBagInterface $params;
    private StripeClient $stripe;
    private TicketRepository $ticketRepository;

    public function __construct(
        ParameterBagInterface $params,
        TicketRepository $ticketRepository
    ) {
        $this->params = $params;
        $this->stripe = new StripeClient($this->params->get('stripeSecret'));
        $this->ticketRepository = $ticketRepository;
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
                        'name' => $paymentRequest->getFlightId(),
                        'metadata' => [
                            "passengerId" => $paymentRequest->getPassengerId(),
                            "discountId" => $paymentRequest->getDiscountId(),
                            "flightId" => $paymentRequest->getFlightId(),
                            "seatTypeId" => $paymentRequest->getSeatTypeId(),
                            "totalPrice" => $paymentRequest->getTotalPrice(),
                            "ticketOwner" => $paymentRequest->getTicketOwner()
                        ],
                    ],
                    'unit_amount' => $paymentRequest->getTotalPrice(),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            'success_url' => StripeConstant::SUCCESS_URL,
            'cancel_url' => StripeConstant::FAILED_URL,
        ]);
    }


    public function eventHandler(array $data, string $type): void
    {
        $ticket = new Ticket();
        if ($type === self::CHECK_COMPLETED) {
            $ticket->setPassenger($data['metadata']['accountId']);
            $ticket->setDiscount($data['metadata']['discountId']);
            $ticket->setFlight($data['metadata']['flightId']);
            $ticket->setSeatType($data['metadata']['seatTypeId']);
            $ticket->setTotalPrice($data['metadata']['totalPrice']);
            $ticket->setTicketOwner($data['metadata']['ticketOwner']);

            $this->ticketRepository->add($ticket);
        }
    }
}
