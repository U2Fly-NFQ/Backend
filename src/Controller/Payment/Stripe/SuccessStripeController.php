<?php

namespace App\Controller\Payment\Stripe;


use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payment', name: 'api_stripe_')]
class SuccessStripeController
{
    #[Route('/stripe/success', name: 'success')]
    public function index()
    {

    }
}
