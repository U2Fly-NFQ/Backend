<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Ticket;

class TicketTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'account', 'flight', 'totalPrice', 'ticketOwner'];
    const FLIGHT_ATTRIBUTE = ['arrival', 'departure', 'startTime'];
    const ACCOUNT_ATTRIBUTE = ['email'];

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
        $result['account'] = $this->transform($ticket->getAccount(), self::ACCOUNT_ATTRIBUTE);
        $result['discount'] = $ticket->getDiscount()->getId();
        $result['seatType'] = $ticket->getSeatType()->getName();
        $result['flight'] = $this->transform($ticket->getFlight(), self::FLIGHT_ATTRIBUTE);
        $result['flight']['startTime'] = $result['flight']['startTime']->format('Y-m-d H:i:s');
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
