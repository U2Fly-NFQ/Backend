<?php

namespace App\Controller\Payment\Stripe;

use App\Service\StripeService;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/stripe_webhook', name: 'api_stripe_')]
class WebhookController extends AbstractController
{
    #[Route('/', name: 'webhook')]
    public function index(Request $request, StripeService $stripeService, LoggerInterface $logger): JsonResponse
    {
        $logger->debug($request);

        $event = $request->toArray();
        $data = $event['data']['object'];
        $type = $event['type'];
        $metadata = $data['metadata'];
        $stripeService->eventHandler($type, $metadata);

        return $this->json([]);
    }
}
