<?php

namespace App\Service;

use App\Request\PaymentRequest;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StripeService
{
    private const CHECK_COMPLETED = 'checkout.session.completed';

    private ParameterBagInterface $params;
    private StripeClient $stripe;

    public function __construct(
        ParameterBagInterface $params,
    ) {
        $this->params = $params;
        $this->stripe = new StripeClient($this->params->get('stripeSecret'));
    }

    /**
     * @throws ApiErrorException
     */
    public function checkout(PaymentRequest $paymentRequest): Session
    {
        $stripeSK = $this->params->get('stripeSecret');
        Stripe::setApiKey($stripeSK);
        return Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $paymentRequest->getItem(),
                    ],
                    'unit_amount' => $paymentRequest->getTotalPrice(),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://google.com',
            'cancel_url' => 'https://www.google.com/search?q=con+heo&client=ubuntu&hs=XIO&channel=fs&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjH6tXh6dz4AhVbnNgFHeTWAjgQ_AUoAXoECAEQAw&biw=1538&bih=807&dpr=1.2#imgrc=Oe-CO3CS8HM6NM',
        ]);
    }
}
