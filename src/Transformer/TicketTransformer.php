<?php

namespace App\Transformer;

use App\Entity\Ticket;

class TicketTransformer
{
    public function objectToArray(Ticket $ticket): array
    {
        return [
            'id' => $ticket->getId(),
            'accountId' => $ticket->getAccount()->getId(),
            'flightId' => $ticket->getFlight()->getId(),
            'discountId' => $ticket->getDiscount()->getId(),
            'totalPrice' => $ticket->getTotalPrice()
        ];
    }
}
