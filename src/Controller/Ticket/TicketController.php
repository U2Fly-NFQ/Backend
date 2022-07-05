<?php

namespace App\Controller\Ticket;

use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest;
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

    #[Route('/tickets', name: 'admin_list', methods: 'GET')]
    public function index(
        TicketRequest $ticketRequest,
        Request $request,
        TicketService $ticketService
    ): Response {
        $params = $request->query->all();
        $ticketData = $ticketRequest->fromArray($params);
        $tickets = $ticketService->findAll($ticketData);

        return $this->success($tickets);
    }

    #[Route('/tickets/{id}', name: 'findById', methods: 'GET')]
    public function findById(int $id, TicketRepository $ticketRepository, TicketTransformer $ticketTransformer)
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
        $ticketFlightService->add($ticket, $flights);

        return $this->success([], Response::HTTP_CREATED);
    }
//
//    #[Route('/tickets/cancel/{id}', name: 'cancel', methods: 'POST')]
//    public function cancel(int $id, TicketRepository $ticketRepository, TicketService $ticketService): Response
//    {
//        $ticket = $ticketRepository->find($id);
//        $ticketService->cancel($ticket);
//
//        return $this->success([]);
//    }
}
