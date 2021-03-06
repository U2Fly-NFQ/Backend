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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_ticket')]
class TicketController
{
    use JsonTrait;

    #[IsGranted('ROLE_ADMIN')]
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
        if ($ticket == null) {
            throw new Exception('Ticket not found', Response::HTTP_BAD_REQUEST);
        }
        $data = $ticketTransformer->toArray($ticket);

        return $this->success($data);
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
