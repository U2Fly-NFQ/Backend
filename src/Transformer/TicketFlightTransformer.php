<?php

namespace App\Transformer;

use App\Entity\TicketFlight;

class TicketFlightTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'isIsRating'];
    private FlightTransformer $flightTransformer;

    public function __construct(FlightTransformer $flightTransformer)
    {
        $this->flightTransformer = $flightTransformer;
    }

    public function toArray(TicketFlight $ticketFlight): array
    {
        $result = $this->transform($ticketFlight, self::BASE_ATTRIBUTE);
        $result['isRating'] = $ticketFlight->isIsRating();
        $result['createdAt'] = $ticketFlight->getCreatedAt();
        $ticketFlight->getFlight() == null ? $result['flight'] == null : $result['flight'] = $this->flightTransformer->toArray($ticketFlight->getFlight());
        $result['ticket'] = $ticketFlight->getTicket();

        return $result;
    }
}
