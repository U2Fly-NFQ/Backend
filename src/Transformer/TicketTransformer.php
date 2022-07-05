<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Passenger;
use App\Entity\Ticket;
use App\Traits\DateTimeTrait;

class TicketTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'passenger', 'totalPrice', 'ticketOwner'];
    const FLIGHT_ATTRIBUTE = ['arrival', 'departure', 'startTime'];

    use DateTimeTrait;

    private PassengerTransformer $passengerTransformer;

    public function __construct(PassengerTransformer $passengerTransformer)
    {
        $this->passengerTransformer = $passengerTransformer;
    }

    public function toArrayList(array $tickets): array
    {
        $ticketList = [];
        foreach ($tickets as $ticket) {
            $ticketList[] = $this->toArray($ticket);
        }

        return $ticketList;
    }

    public function toArray(Ticket $ticket): array
    {
        $result = $this->transform($ticket, self::BASE_ATTRIBUTE);
        $result['id'] = $ticket->getId();
        $result['passenger'] = $this->passengerTransformer->toArray($ticket->getPassenger());
        $result['discount'] = $ticket->getDiscount()->getId();
        $result['seatType'] = $ticket->getSeatType()->getName();
        $result['createdAt'] = $ticket->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if ($ticket->getUpdatedAt()) {
            $result['updatedAt'] = $ticket->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }
        if ($ticket->getCancelAt()) {
            $result['cancelAt'] = $ticket->getCancelAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }

        return $result;
    }
}
