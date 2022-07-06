<?php

namespace App\Service;

use App\Constant\StripeConstant;
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
    private TicketService $ticketService;

    public function __construct(
        ParameterBagInterface $params,
        TicketService $ticketService
    ) {
        $this->params = $params;
        $this->stripe = new StripeClient($this->params->get('stripeSecret'));
        $this->ticketService = $ticketService;
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
}
