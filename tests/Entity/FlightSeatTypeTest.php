<?php

namespace App\Tests\Entity;

use App\Entity\Flight;
use App\Entity\FlightSeatType;
use App\Entity\SeatType;
use DateTime;
use PHPUnit\Framework\TestCase;

class FlightSeatTypeTest extends TestCase
{
    public function testGetId()
    {
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setId(1);
        $result = $flightSeatType->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetPrice()
    {
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setPrice(100);
        $result = $flightSeatType->getPrice();

        $this->assertEquals(100, $result);
    }

    public function testGetSeatAvailable()
    {
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setSeatAvailable(100);
        $result = $flightSeatType->getSeatAvailable();

        $this->assertEquals(100, $result);
    }

    public function testGetDiscount()
    {
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setDiscount(1);
        $result = $flightSeatType->getDiscount();

        $this->assertEquals(1, $result);
    }

    public function testGetLuggageWeight()
    {
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setLuggageWeight(7);
        $result = $flightSeatType->getLuggageWeight();

        $this->assertEquals(7, $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setCreatedAt($date);
        $result = $flightSeatType->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setDeletedAt($date);
        $result = $flightSeatType->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setUpdatedAt($date);
        $result = $flightSeatType->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetFlight()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setFlight($flight);
        $result = $flightSeatType->getFlight();

        $this->assertEquals($flight, $result);
    }

    public function testGetSeatType()
    {
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $flightSeatType = new FlightSeatType();
        $flightSeatType->setSeatType($seatType);
        $result = $flightSeatType->getSeatType();

        $this->assertEquals($seatType, $result);
    }
}
