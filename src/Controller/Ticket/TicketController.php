<?php

namespace App\Controller\Ticket;

use App\Request\AddTicketRequest;
use App\Service\TicketService;
use App\Traits\JsonTrait;
use App\Transformer\TicketTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_ticket')]
class TicketController
{
    use JsonTrait;

    #[Route('/tickets', name: 'list')]
    public function index()
    {
    }

    #[Route('/ticket/add', name: 'add')]
    public function add(
        Request           $request,
        AddTicketRequest  $addTicketRequest,
        TicketService     $ticketService,
        TicketTransformer $ticketTransformer
    )
    {
        $requestBody = json_decode($request->getContent(), true);
        $ticketRequest = $addTicketRequest->fromArray($requestBody);

        $ticket = $ticketService->add($ticketRequest);
        $ticket = $ticketTransformer->objectToArray($ticket);

        return $this->success($ticket);

    }
}
