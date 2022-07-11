<?php

namespace App\Tests\Request;

use App\Entity\Flight;
use App\Request\AddTicketRequest;
use PHPUnit\Framework\TestCase;

class AddTicketRequestTest extends TestCase
{
    public function testGetPassengerId()
    {
        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setPassengerId(1);
        $result = $addTicketRequest->getPassengerId();

        $this->assertEquals(1, $result);
    }

    public function testGetDiscount()
    {
        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setDiscountId(1);
        $result = $addTicketRequest->getDiscountId();

        $this->assertEquals(1, $result);
    }

    public function testGetFlight()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setFlights([$flight]);
        $result = $addTicketRequest->getFlights();

        $this->assertEquals([$flight], $result);
    }

    public function testGetSeatTypeId()
    {

        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setSeatTypeId(1);
        $result = $addTicketRequest->getSeatTypeId();

        $this->assertEquals(1, $result);
    }

    public function testGetTotalPrice()
    {

        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setTotalPrice(5000);
        $result = $addTicketRequest->getTotalPrice();

        $this->assertEquals(5000, $result);
    }

    public function testGetTicketOwner()
    {

        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setTicketOwner('Sang');
        $result = $addTicketRequest->getTicketOwner();

        $this->assertEquals('Sang', $result);
    }
}
