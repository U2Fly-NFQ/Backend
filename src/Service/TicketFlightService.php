<?php

namespace App\Service;

use App\Entity\TicketFlight;
use App\Repository\AirplaneSeatTypeRepository;
use App\Repository\FlightRepository;
use App\Repository\TicketFlightRepository;
use Exception;

class TicketFlightService
{
    private TicketFlightRepository $ticketFlightRepository;
    private FlightRepository $flightRepository;
    private AirplaneSeatTypeService $airplaneSeatTypeService;


    /**
     * @param TicketFlightRepository $ticketFlightRepository
     */
    public function __construct(
        TicketFlightRepository $ticketFlightRepository,
        FlightRepository $flightRepository,
        AirplaneSeatTypeService $airplaneSeatTypeService
    ) {
        $this->ticketFlightRepository = $ticketFlightRepository;
        $this->flightRepository = $flightRepository;
        $this->airplaneSeatTypeService = $airplaneSeatTypeService;
    }

    /**
     * @param $ticket
     * @param $flights
     * @param $seatType
     * @return void
     * @throws Exception
     */
    public function add($ticket, $flights, $seatType)
    {
        foreach ($flights as $flightId) {
            $flight = $this->flightRepository->find($flightId);
            $this->addToDatabase($ticket, $flight);
            $this->airplaneSeatTypeService->updateAvailableSeats($flight, $seatType, -1);
        }
    }

    /**
     * @param $ticket
     * @param $flight
     * @return void
     */
    private function addToDatabase($ticket, $flight): void
    {
        $ticketFlight = new TicketFlight();
        $ticketFlight->setTicket($ticket);
        $ticketFlight->setFlight($flight);
        $this->ticketFlightRepository->add($ticketFlight, true);
    }

}
