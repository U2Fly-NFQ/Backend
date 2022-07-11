<?php

namespace App\Tests\Entity;

use App\Entity\Airplane;
use App\Entity\Flight;
use App\Entity\FlightSeatType;
use App\Entity\Ticket;
use App\Entity\TicketFlight;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class FlightTest extends TestCase
{
    public function testGetId()
    {
        $flight = new Flight();
        $flight->setId(1);
        $result = $flight->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetFlightSeatType()
    {
        $flightSeatType = $this->getMockBuilder(Collection::class)->disableOriginalConstructor()->getMock();
        $flight = new Flight();
        $flight->setFlightSeatTypes($flightSeatType);
        $result = $flight->getFlightSeatTypes();

        $this->assertEquals($flightSeatType, $result);
    }

    public function testGetAirplane()
    {
        $airplane = $this->getMockBuilder(Airplane::class)->disableOriginalConstructor()->getMock();
        $flight = new Flight();
        $flight->setAirplane($airplane);
        $result = $flight->getAirplane();

        $this->assertEquals($airplane, $result);
    }

    public function testGetTicketFlight()
    {
        $ticketFlight = $this->getMockBuilder(ArrayCollection::class)->disableOriginalConstructor()->getMock();
        $flight = new Flight();
        $flight->setTicketFlights($ticketFlight);
        $result = $flight->getTicketFlights();

        $this->assertEquals($ticketFlight, $result);
    }

    public function testGetCode()
    {
        $flight = new Flight();
        $flight->setCode('VN156');
        $result = $flight->getCode();

        $this->assertEquals('VN156', $result);
    }

    public function testGetArrival()
    {
        $flight = new Flight();
        $flight->setArrival('HAN');
        $result = $flight->getArrival();

        $this->assertEquals('HAN', $result);
    }

    public function testGetDeparture()
    {
        $flight = new Flight();
        $flight->setDeparture('VCA');
        $result = $flight->getDeparture();

        $this->assertEquals('VCA', $result);
    }

    public function testGetStartTime()
    {
        $time = new DateTime('16:22:00');
        $flight = new Flight();
        $flight->setStartTime($time);
        $result = $flight->getStartTime();

        $this->assertEquals($time, $result);
    }

    public function testGetStartDate()
    {
        $time = new DateTime('2020-07-07');
        $flight = new Flight();
        $flight->setStartDate($time);
        $result = $flight->getStartDate();

        $this->assertEquals($time, $result);
    }

    public function testGetDuration()
    {
        $flight = new Flight();
        $flight->setDuration(1.5);
        $result = $flight->getDuration();

        $this->assertEquals(1.5, $result);
    }

    public function testGetIsRefund()
    {
        $flight = new Flight();
        $flight->setIsRefund(true);
        $result = $flight->getIsRefund();

        $this->assertEquals(1, $result);
    }

    public function testGetCreatedAt()
    {
        $time = new DateTime('2020-07-07');
        $flight = new Flight();
        $flight->setCreatedAt($time);
        $result = $flight->getCreatedAt();

        $this->assertEquals($time, $result);
    }

    public function testGetUpdatedAt()
    {
        $time = new DateTime('2020-07-07');
        $flight = new Flight();
        $flight->setUpdatedAt($time);
        $result = $flight->getUpdatedAt();

        $this->assertEquals($time, $result);
    }

    public function testGetDeletedAt()
    {
        $time = new DateTime('2020-07-07');
        $flight = new Flight();
        $flight->setDeletedAt($time);
        $result = $flight->getDeletedAt();

        $this->assertEquals($time, $result);
    }
}
