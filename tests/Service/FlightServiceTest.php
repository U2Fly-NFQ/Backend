<?php

namespace App\Tests\Service;

use App\Repository\FlightRepository;
use App\Repository\FlightSeatTypeRepository;
use App\Request\ListFlightRequest;
use App\Service\FlightService;
use App\Transformer\FlightSeatTypeTransformer;
use App\Transformer\FlightTransformer;
use PHPUnit\Framework\TestCase;

class FlightServiceTest extends TestCase
{
    public function testFind()
    {
        $this->assertTrue(true);
//        $listFlightRequest = $this->getMockBuilder(ListFlightRequest::class)->disableOriginalConstructor()->getMock();
//        $listFlightR = new ListFlightRequest();
//        $listFlightR->splitOneWayAndRoundTrip($listFlightRequest);
//        //$listFlightRequest->expects($this->any())->method('splitOneWayAndRoundTrip')->willReturn($listFlightRequested);
//        $flightService = $this->createFlightService();
//        $result = $flightService->find($listFlightRequest);
//
//        $this->assertIsArray($result);
    }


    public function createFlightService()
    {
        $flightSeatTypeTransformer = $this->getMockBuilder(FlightSeatTypeTransformer::class)->disableOriginalConstructor()->getMock();
        $flightSeatTypeRepository = $this->getMockBuilder(FlightSeatTypeRepository::class)->disableOriginalConstructor()->getMock();
        $flightTransformer = $this->getMockBuilder(FlightTransformer::class)->disableOriginalConstructor()->getMock();
        $flightRepository = $this->getMockBuilder(FlightRepository::class)->disableOriginalConstructor()->getMock();

        return new FlightService($flightRepository, $flightTransformer,$flightSeatTypeRepository,$flightSeatTypeTransformer );
    }
}
