<?php

namespace App\Service;

use App\Constant\StripeConstant;
use App\Repository\TicketRepository;
use App\Request\RefundRequest;
use App\Request\StripePaymentRequest;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StripeService
{
    const CHECK_COMPLETED = 'checkout.session.completed';

    private ParameterBagInterface $parameterBag;
    private StripeClient $stripe;
    private TicketService $ticketService;
    private TicketRepository $ticketRepository;

    public function __construct(
        ParameterBagInterface $params,
        TicketService $ticketService,
        TicketRepository $ticketRepository
    ) {
        $this->parameterBag = $params;
        $this->stripe = new StripeClient($this->parameterBag->get('stripeSecret'));
        $this->ticketService = $ticketService;
        $this->ticketRepository = $ticketRepository;
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

    public function refund(RefundRequest $refundRequest)
    {
        $ticket = $this->ticketRepository->findOneBy(['paymentId'=>$refundRequest->getPaymentId()]);
        $ok=  $this->ticketService->cancel($ticket);
        dd($ok);




        $stripeSK = $this->parameterBag->get('stripeSecret');
        Stripe::setApiKey($stripeSK);

    }
}
