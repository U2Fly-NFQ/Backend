<?php

namespace App\Controller\Payment\Stripe;


use App\Constant\StripeConstant;
use App\Service\TicketService;
use App\Traits\JsonTrait;
use App\Transformer\TicketTransformer;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payment', name: 'api_stripe_')]
class SuccessStripeController
{
    use JsonTrait;

    /**
     * @throws ApiErrorException
     */
    #[Route('/stripe/success', name: 'success')]
    public function index(Request               $request,
                          ParameterBagInterface $parameterBag,
                          TicketService         $ticketService,
    ): RedirectResponse
    {

        Stripe::setApiKey($parameterBag->get('stripeSecret'));
        $session = Session::retrieve($request->get('session_id'));
        $sessionArray = $session->toArray();
        $ticket = $ticketService->addByArrayData($sessionArray['metadata']);

    return new RedirectResponse(StripeConstant::TARGET_URL .'/'. $ticket->getId());
    }
}
