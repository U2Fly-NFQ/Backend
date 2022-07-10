<?php

namespace App\Tests\Mapper;

use App\Entity\Airline;
use App\Mapper\AddAirlineRequestToAirline;
use App\Request\AirlineRequest;
use PHPUnit\Framework\TestCase;

class AddAirlineRequestToAirlineTest extends TestCase
{
    public function testMapper()
    {
        $airlineRequest = $this->getMockBuilder(AirlineRequest::class)->disableOriginalConstructor()->getMock();
        $addAirlineRequestToAirline = new AddAirlineRequestToAirline();
        $result = $addAirlineRequestToAirline->mapper($airlineRequest);
        $this->assertInstanceOf(Airline::class, $result);
    }
}
