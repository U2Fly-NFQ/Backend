<?php

namespace App\Service;

use App\Entity\TicketFlight;
use App\Repository\FlightRepository;
use App\Repository\TicketFlightRepository;

class TicketFlightService
{
    private TicketFlightRepository $ticketFlightRepository;
    private FlightRepository $flightRepository;

    /**
     * @param TicketFlightRepository $ticketFlightRepository
     */
    public function __construct(TicketFlightRepository $ticketFlightRepository, FlightRepository $flightRepository)
    {
        $this->ticketFlightRepository = $ticketFlightRepository;
        $this->flightRepository = $flightRepository;
    }

    /**
     * @param $ticket
     * @param $flights
     * @return void
     */
    public function add($ticket, $flights)
    {
        foreach ($flights as $flight){
            $this->addToDatabase($ticket, $flight);
        }
    }

    /**
     * @param $ticket
     * @param $flightId
     * @return void
     */
    private function addToDatabase($ticket, $flightId): void
    {
        $flight = $this->flightRepository->find($flightId);
        $ticketFlight = new TicketFlight();
        $ticketFlight->setTicket($ticket);
        $ticketFlight->setFlight($flight);
        $this->ticketFlightRepository->add($ticketFlight, true);
    }
}
