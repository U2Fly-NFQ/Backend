<?php

namespace App\Controller\Ticket;

use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest\ListTicketRequest;
use App\Service\TicketFlightService;
use App\Service\TicketService;
use App\Traits\JsonTrait;
use App\Transformer\TicketTransformer;
use App\Validation\RequestValidation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_ticket')]
class TicketController
{
    use JsonTrait;

    #[Route('/admin/tickets', name: 'admin_list', methods: 'GET')]
    public function list(TicketRepository $ticketRepository, TicketTransformer $ticketTransformer): Response
    {
        $tickets = $ticketRepository->findAll();
        $data = $ticketTransformer->toArrayList($tickets);

        return $this->success($data);
    }

    /**
     * @throws \Exception
     */
    #[Route('/tickets', name: 'user_list', methods: 'GET')]
    public function userList(
        ListTicketRequest $listTicketRequest,
        Request $request,
        TicketService $ticketService,
        RequestValidation $requestValidation
    ): Response {
        $params = $request->query->all();
        $ticketData = $listTicketRequest->fromArray($params);
        $requestValidation->validate($ticketData);
        $tickets = $ticketService->findAll($ticketData);

        return $this->success($tickets);
    }

    #[Route('/tickets/{id}', name: 'findById', methods: 'GET')]
    public function findById(int $id, TicketRepository $ticketRepository, TicketTransformer $ticketTransformer): Response
    {
        $ticket = $ticketRepository->find($id);
        $data = $ticketTransformer->toArray($ticket);

        return $this->success($data);
    }

    /**
     * @throws \Exception
     */
    #[Route('/tickets', name: 'add', methods: 'POST')]
    public function add(
        Request $request,
        AddTicketRequest $addTicketRequest,
        TicketService $ticketService,
        RequestValidation $requestValidation,
        TicketFlightService $ticketFlightService,
    ): Response {
        $requestBody = json_decode($request->getContent(), true);
        $flights = $requestBody['flights'];
        $ticketRequest = $addTicketRequest->fromArray($requestBody);
        $requestValidation->validate($ticketRequest);
        $ticket = $ticketService->add($ticketRequest);
        $ticketFlightService->add($ticket, $flights, $ticket->getSeatType());

        return $this->success([], Response::HTTP_CREATED);
    }

    /**
     * @throws \Exception
     */
    #[Route('/tickets/cancel/{id}', name: 'cancel', methods: 'POST')]
    public function cancel(int $id, TicketRepository $ticketRepository, TicketService $ticketService): Response
    {
        $ticket = $ticketRepository->find($id);
        $ticketService->cancel($ticket);

        return $this->success([]);
    }
}
