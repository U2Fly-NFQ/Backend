<?php

namespace App\Tests\Service;

use App\Entity\Flight;
use App\Entity\SeatType;
use App\Entity\Ticket;
use App\Repository\FlightRepository;
use App\Repository\TicketFlightRepository;
use App\Service\AirplaneSeatTypeService;
use App\Service\TicketFlightService;
use PHPUnit\Framework\TestCase;

class TicketFlightServiceTest extends TestCase
{
    public function testAdd()
    {
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $ticketFlightService = $this->createTicketFlightService();
        $result = $ticketFlightService->add($ticket, [1], $seatType);

        $this->assertTrue($result);
    }

    public function createTicketFlightService()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository = $this->getMockBuilder(TicketFlightRepository::class)->disableOriginalConstructor()->getMock();
        $flightRepository = $this->getMockBuilder(FlightRepository::class)->disableOriginalConstructor()->getMock();
        $flightRepository->expects($this->any())->method('find')->willReturn($flight);
        $flightSeatType = $this->getMockBuilder(AirplaneSeatTypeService::class)->disableOriginalConstructor()->getMock();

        return new TicketFlightService($ticketFlightRepository, $flightRepository, $flightSeatType);
    }
}
