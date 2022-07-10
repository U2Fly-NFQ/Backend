<?php

namespace App\Tests\Entity;

use App\Entity\Discount;
use App\Entity\Passenger;
use App\Entity\SeatType;
use App\Entity\Ticket;
use DateTime;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    public function testGetId()
    {
        $ticket = new Ticket();
        $ticket->setId(1);
        $result = $ticket->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetPassenger()
    {
        $passenger = $this->getMockBuilder(Passenger::class)->disableOriginalConstructor()->getMock();
        $ticket = new Ticket();
        $ticket->setPassenger($passenger);
        $result = $ticket->getPassenger();

        $this->assertEquals($passenger, $result);
    }

    public function testGetDiscount()
    {
        $discount = $this->getMockBuilder(Discount::class)->disableOriginalConstructor()->getMock();
        $ticket = new Ticket();
        $ticket->setDiscount($discount);
        $result = $ticket->getDiscount();

        $this->assertEquals($discount, $result);
    }

    public function testGetTotalPrice()
    {
        $ticket = new Ticket();
        $ticket->setTotalPrice(5000);
        $result = $ticket->getTotalPrice();

        $this->assertEquals(5000, $result);
    }

    public function testGetSeatType()
    {
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $ticket = new Ticket();
        $ticket->setSeatType($seatType);
        $result = $ticket->getSeatType();

        $this->assertEquals($seatType, $result);
    }

    public function testGetTicketFlight()
    {
        $ticketFlight = $this->getMockBuilder(Collection::class)->disableOriginalConstructor()->getMock();
        $ticket = new Ticket();
        $ticket->setTicketFlights($ticketFlight);
        $result = $ticket->getTicketFlights();

        $this->assertEquals($ticketFlight, $result);
    }

    public function testGetStatus()
    {
        $ticket = new Ticket();
        $ticket->setStatus(1);
        $result = $ticket->getStatus();

        $this->assertEquals(1, $result);
    }

    public function testGetPaymentId()
    {
        $ticket = new Ticket();
        $ticket->setPaymentId('pi_3LJh5pGLKOTVyCxb0wJZnmAA');
        $result = $ticket->getPaymentId();

        $this->assertEquals('pi_3LJh5pGLKOTVyCxb0wJZnmAA', $result);
    }

    public function testGetTicketOwner()
    {
        $ticket = new Ticket();
        $ticket->setTicketOwner('Sang');
        $result = $ticket->getTicketOwner();

        $this->assertEquals('Sang', $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2022-07-09 17:30:21');
        $ticket = new Ticket();
        $ticket->setCreatedAt($date);
        $result = $ticket->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2022-07-09 17:30:21');
        $ticket = new Ticket();
        $ticket->setUpdatedAt($date);
        $result = $ticket->getUpdatedAt();

        $this->assertEquals($date, $result);
    }
}
