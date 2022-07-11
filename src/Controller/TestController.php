<?php

namespace App\Controller;

use App\Event\MailerEvent;
use App\Repository\TicketRepository;
use App\Traits\JsonTrait;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    use JsonTrait;

    #[Route('api/test', name: 'test')]
    public function index(
        TicketRepository         $ticketRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $ticket = $ticketRepository->find(41);
        $event = new MailerEvent($ticket);
        $eventDispatcher->dispatch($event, 'event.successMail');
        return $this->success([]);
    }
}
