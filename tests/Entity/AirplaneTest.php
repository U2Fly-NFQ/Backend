<?php

namespace App\Tests\Entity;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\Flight;
use DateTime;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AirplaneTest extends TestCase
{
    public function testGetId()
    {
        $airplane = new Airplane();
        $airplane->setId(1);
        $result = $airplane->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetName()
    {
        $airplane = new Airplane();
        $airplane->setName('Boeing 787');
        $result = $airplane->getName();

        $this->assertEquals('Boeing 787', $result);
    }

    public function testAirline()
    {
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $airplane = new Airplane();
        $airplane->setAirline($airline);
        $result = $airplane->getAirline();

        $this->assertEquals($airline, $result);
    }

    public function testCreatedAt()
    {
        $date = new DateTime('2022-07-07 16:10:00');
        $airplane = new Airplane();
        $airplane->setCreatedAt($date);
        $result = $airplane->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testUpdatedAt()
    {
        $date = new DateTime('2022-07-07 16:10:00');
        $airplane = new Airplane();
        $airplane->setUpdatedAt($date);
        $result = $airplane->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2022-07-07 16:10:00');
        $airplane = new Airplane();
        $airplane->setDeletedAt($date);
        $result = $airplane->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetFlight()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $airplane = new Airplane();
        $airplane->addFlight($flight);
        $result = $airplane->getFlights();

        $this->assertInstanceOf(Collection::class, $result);
    }
}
