<?php

namespace App\Controller\Payment;

use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_stripe')]
class StripeController
{
    #[Route('/stripe', name: 'pay')]
    public function pay()
    {

    }
}
