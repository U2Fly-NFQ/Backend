<?php

namespace App\Controller\Ticket;

use App\Request\AddTicketRequest;
use App\Service\TicketService;
use App\Traits\JsonTrait;
use App\Transformer\TicketTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_ticket')]
class TicketController
{
    use JsonTrait;

    #[Route('/tickets', name: 'list', methods: 'GET')]
    public function index()
    {
    }

    #[Route('/tickets', name: 'add', methods: 'POST')]
    public function add(
        Request $request,
        AddTicketRequest $addTicketRequest,
        TicketService $ticketService,
        TicketTransformer $ticketTransformer
    ) {
        $requestBody = json_decode($request->getContent(), true);
        $ticketRequest = $addTicketRequest->fromArray($requestBody);

        $ticket = $ticketService->add($ticketRequest);
        $ticket = $ticketTransformer->objectToArray($ticket);

        return $this->success($ticket, Response::HTTP_CREATED);
    }
}
