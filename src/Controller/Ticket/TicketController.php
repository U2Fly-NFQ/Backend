<?php

namespace App\Controller\Ticket;

use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest;
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

    #[Route('/manage/tickets', name: 'admin_list', methods: 'GET')]
    public function index(
        TicketTransformer $ticketTransformer,
        TicketRequest $ticketRequest,
        Request $request,
        TicketService $ticketService
    ): Response {
        $params = $request->query->all();
        $ticketData = $ticketRequest->fromArray($params);
        $tickets = $ticketService->findAll($ticketData);

        return $this->success($tickets);
    }

    #[Route('/tickets', name: 'add', methods: 'POST')]
    public function add(
        Request $request,
        AddTicketRequest $addTicketRequest,
        TicketService $ticketService
    ): Response {
        $requestBody = json_decode($request->getContent(), true);
        $ticketRequest = $addTicketRequest->fromArray($requestBody);

        $ticketService->add($ticketRequest);

        return $this->success([], Response::HTTP_CREATED);
    }

    #[Route('/tickets/cancel/{id}', name: 'cancel', methods: 'POST')]
    public function cancel(int $id, TicketRepository $ticketRepository, TicketService $ticketService): Response
    {
        $ticket = $ticketRepository->find($id);
        $ticketService->cancel($ticket);

        return $this->success([]);
    }
}
