<?php

namespace App\Tests\Entity;

use App\Entity\SeatType;
use App\Entity\Ticket;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class SeatTypeTest extends TestCase
{
    public function testGetId()
    {
        $seatType = new SeatType();
        $seatType->setId(1);
        $result = $seatType->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetName()
    {
        $seatType = new SeatType();
        $seatType->setName('Economy');
        $result = $seatType->getName();

        $this->assertEquals('Economy', $result);
    }

    public function testGetTickets()
    {
        $ticket = $this->getMockBuilder(ArrayCollection::class)->disableOriginalConstructor()->getMock();
        $seatType = new SeatType();
        $seatType->setTickets($ticket);
        $result = $seatType->getTickets();

        $this->assertEquals($ticket, $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2022-07-07 16:04:00');
        $seatType = new SeatType();
        $seatType->setCreatedAt($date);
        $result = $seatType->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2022-07-07 16:04:00');
        $seatType = new SeatType();
        $seatType->setDeletedAt($date);
        $result = $seatType->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2022-07-07 16:04:00');
        $seatType = new SeatType();
        $seatType->setUpdatedAt($date);
        $result = $seatType->getUpdatedAt();

        $this->assertEquals($date, $result);
    }
}
