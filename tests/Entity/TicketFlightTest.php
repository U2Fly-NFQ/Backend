<?php

namespace App\Tests\Entity;

use App\Entity\Flight;
use App\Entity\Ticket;
use App\Entity\TicketFlight;
use DateTime;
use PHPUnit\Framework\TestCase;

class TicketFlightTest extends TestCase
{
    public function testGetId()
    {
        $ticketFlight = new TicketFlight();
        $ticketFlight->setId(1);
        $result = $ticketFlight->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetFlight()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = new TicketFlight();
        $ticketFlight->setFlight($flight);
        $result = $ticketFlight->getFlight();

        $this->assertEquals($flight, $result);
    }

    public function testGetTicket()
    {
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = new TicketFlight();
        $ticketFlight->setTicket($ticket);
        $result = $ticketFlight->getTicket();

        $this->assertEquals($ticket, $result);
    }

    public function testIsRating()
    {
        $ticketFlight = new TicketFlight();
        $ticketFlight->setIsRating(true);
        $result = $ticketFlight->isIsRating();

        $this->assertEquals(1, $result);
    }

    public function testCreatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $ticketFlight = new TicketFlight();
        $ticketFlight->setCreatedAt($date);
        $result = $ticketFlight->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testDeletedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $ticketFlight = new TicketFlight();
        $ticketFlight->setDeletedAt($date);
        $result = $ticketFlight->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testUpdatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $ticketFlight = new TicketFlight();
        $ticketFlight->setUpdatedAt($date);
        $result = $ticketFlight->getUpdatedAt();

        $this->assertEquals($date, $result);
    }
}
