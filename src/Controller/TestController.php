<?php

namespace App\Controller;

use App\Event\MailerEvent;
use App\Repository\TicketRepository;
use App\Service\MailService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    #[Route('/api/test', name: 'app_test', methods: 'GET')]
    public function test(
        TicketRepository         $ticketRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $ticket = $ticketRepository->find(51);
        $event = new MailerEvent($ticket);
        $eventDispatcher->dispatch($event, 'event.successMail');
        return 1;
    }
}
