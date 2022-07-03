<?php

namespace App\Controller\Payment\Stripe;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/stripe_webhook', name: 'api_stripe_')]
class WebhookController
{
    #[Route('/', name: 'api_stripe_')]
    public function index(Request $request, LoggerInterface $logger)
    {
        $logger->debug($request->getContent());
    }
}
