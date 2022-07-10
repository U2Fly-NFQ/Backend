<?php

namespace App\Transformer;

use App\Entity\TicketFlight;

class TicketFlightTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'isIsRating'];

    public function toArray(TicketFlight $ticketFlight): array
    {
        $result = $this->transform($ticketFlight, self::BASE_ATTRIBUTE);
        $result['isRating'] = $ticketFlight->isIsRating();
        $result['createdAt'] = $ticketFlight->getCreatedAt();
        $result['flight'] = $ticketFlight->getFlight();
        $result['ticket'] = $ticketFlight->getTicket();

        return $result;
    }
}
