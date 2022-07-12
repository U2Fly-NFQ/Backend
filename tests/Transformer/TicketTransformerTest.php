<?php

namespace App\Tests\Transformer;

use App\Entity\Account;
use App\Entity\Discount;
use App\Entity\Flight;
use App\Entity\Passenger;
use App\Entity\SeatType;
use App\Entity\Ticket;
use App\Entity\TicketFlight;
use App\Repository\SeatTypeRepository;
use App\Repository\TicketFlightRepository;
use App\Transformer\FlightTransformer;
use App\Transformer\PassengerTransformer;
use App\Transformer\TicketFlightTransformer;
use App\Transformer\TicketTransformer;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class TicketTransformerTest extends TestCase
{
    /**
     * @return void
     */
    public function testToArray(): void
    {
        $ticket = $this->createTicket();
        $ticketTransformer = $this->createTicketTransformer();
        $result = $ticketTransformer->toArray($ticket);

        $this->assertIsArray($result);
    }

    /**
     * @return void
     */
    public function testToArrayList(): void
    {
        $ticket = $this->createTicket();
        $ticketTransformer = $this->createTicketTransformer();
        $result = $ticketTransformer->toArrayList([$ticket]);
        $this->assertIsArray($result);
    }

    /**
     * @return Ticket|\PHPUnit\Framework\MockObject\MockObject
     */
    public function createTicket(): Ticket|\PHPUnit\Framework\MockObject\MockObject
    {
        $date = new DateTime('2020-1-1');
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $passenger = $this->getMockBuilder(Passenger::class)->disableOriginalConstructor()->getMock();
        $passenger->expects($this->any())->method('getAccount')->willReturn($account);
        $ticketFlight = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticketFlights = new ArrayCollection([$ticketFlight]);
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticket->expects($this->any())->method('getTicketFlights')->willReturn($ticketFlights);
        $ticket->expects($this->any())->method('getPassenger')->willReturn($passenger);
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $ticket->expects($this->any())->method('getSeatType')->willReturn($seatType);
        $ticket->expects($this->any())->method('getUpdatedAt')->willReturn($date);

        return $ticket;
    }

    /**
     * @return TicketTransformer
     */
    private function createTicketTransformer(): TicketTransformer
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlight->expects($this->any())->method('getFlight')->willReturn($flight);
        $passengerTransformer = $this->getMockBuilder(PassengerTransformer::class)->disableOriginalConstructor()->getMock();
        $flightTransformer = $this->getMockBuilder(FlightTransformer::class)->disableOriginalConstructor()->getMock();
        $ticketFlightTransformer = $this->getMockBuilder(TicketFlightTransformer::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository = $this->getMockBuilder(TicketFlightRepository::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository->expects($this->any())->method('findBy')->willReturn([$ticketFlight]);
        $seatTypeRepository = $this->getMockBuilder(SeatTypeRepository::class)->disableOriginalConstructor()->getMock();

        return new TicketTransformer($passengerTransformer, $flightTransformer, $ticketFlightTransformer, $ticketFlightRepository, $seatTypeRepository);
    }
}
