<?php

namespace App\Transformer;

use App\Entity\Ticket;

class TicketTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'account', 'flight','ticketOwner'];
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
        $result['flight'] = $this->transform($ticket->getFlight(), self::FLIGHT_ATTRIBUTE);
        $result['flight']['startTime'] = $result['flight']['startTime']->format('Y-m-d H:i:s');

        return $result;
    }
}
