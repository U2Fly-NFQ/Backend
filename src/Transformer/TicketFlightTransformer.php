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
        $ticketFlight->getFlight() == null ? $result['flight'] == null : $result['flight'] = $ticketFlight->getFlight();
        $ticketFlight->getTicket() == null ? $result['ticket'] == null : $result['ticket'] = $ticketFlight->getTicket();

        return $result;
    }
}
