<?php

namespace App\Tests\Request\RateRequest;

use App\Request\RateRequest\AddRateRequest;
use PHPUnit\Framework\TestCase;

class AddRateRequestTest extends TestCase
{
    public function testGetAccountId()
    {
        $addRateRequest = new AddRateRequest();
        $addRateRequest->setAccountId(1);
        $result = $addRateRequest->getAccountId();

        $this->assertEquals(1, $result);
    }

    public function testGetTicketFlightId()
    {
        $addRateRequest = new AddRateRequest();
        $addRateRequest->setTicketFlightId(1);
        $result = $addRateRequest->getTicketFlightId();

        $this->assertEquals(1, $result);
    }

    public function testGetAirlineId()
    {
        $addRateRequest = new AddRateRequest();
        $addRateRequest->setAirlineId(1);
        $result = $addRateRequest->getAirlineId();

        $this->assertEquals(1, $result);
    }

    public function testGetRate()
    {
        $addRateRequest = new AddRateRequest();
        $addRateRequest->setRate(4);
        $result = $addRateRequest->getRate();

        $this->assertEquals(4, $result);
    }

    public function testGetComment()
    {
        $addRateRequest = new AddRateRequest();
        $addRateRequest->setComment('It was ok');
        $result = $addRateRequest->getComment();

        $this->assertEquals('It was ok', $result);
    }
}
