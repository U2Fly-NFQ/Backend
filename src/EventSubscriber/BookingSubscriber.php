<?php

namespace App\EventSubscriber;

use App\Entity\TicketsStatistic;
use App\Event\BookingEvent;
use App\Repository\TicketsStatisticRepository;
use App\Traits\DateTimeTrait;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookingSubscriber implements EventSubscriberInterface
{
    private TicketsStatisticRepository $ticketsStatisticRepository;
    use DateTimeTrait;

    public function __construct(TicketsStatisticRepository $ticketsStatisticRepository)
    {
        $this->ticketsStatisticRepository = $ticketsStatisticRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            'event.bookingCancel' => 'bookingCancelStatistic',
            'event.bookingSuccess' => 'bookingSuccessStatistic',
        ];
    }

    public function bookingCancelStatistic()
    {
        $date = new DateTime();
        $ticketOfDay = $this->ticketsStatisticRepository->findBy(['date' => $date]);
        $ticketsStatistic = new TicketsStatistic();
        if (empty($ticketOfDay)) {
            $ticketsStatistic->setDate($date);
            $ticketsStatistic->setCancel(1);
            $this->ticketsStatisticRepository->addTicketsStatistic($ticketsStatistic, true);
        } else {
            $this->ticketsStatisticRepository->updateCancelStatistic($ticketOfDay[0]->getId(), $ticketOfDay[0]->getCancel(), $ticketOfDay[0]->getDate());
        }
    }

    public function bookingSuccessStatistic()
    {
        $date = new DateTime();
        $ticketOfDay = $this->ticketsStatisticRepository->findBy(['date' => $date]);
        $ticketsStatistic = new TicketsStatistic();
        if (empty($ticketOfDay)) {
            $ticketsStatistic->setDate($date);
            $ticketsStatistic->setCancel(1);
            $this->ticketsStatisticRepository->addTicketsStatistic($ticketsStatistic, true);
        } else {
            $this->ticketsStatisticRepository->updateSuccessStatistic($ticketOfDay[0]->getId(), $ticketOfDay[0]->getSuccess(), $ticketOfDay[0]->getDate());
        }
    }
}