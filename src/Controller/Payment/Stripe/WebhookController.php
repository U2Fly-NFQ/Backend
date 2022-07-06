<?php

namespace App\Controller\Payment\Stripe;

use App\Service\StripeService;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/webhook', name: 'api_')]
class WebhookController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/', name: 'webhook')]
    public function getData(
        Request $request,
        StripeService $stripeService
    ): JsonResponse {
        $event = $request->toArray();
        $data = $event['data']['object'];
        $metadata = $data['metadata'];
        $type = $event['type'];

        $stripeService->eventHandler($data, $type, $metadata);

        return $this->json(['']);
    }
}
