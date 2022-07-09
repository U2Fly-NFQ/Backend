<?php

namespace App\Tests\Transformer;

use App\Entity\Flight;
use App\Entity\SeatType;
use App\Repository\AirportRepository;
use App\Transformer\AirlineTransformer;
use App\Transformer\AirplaneTransformer;
use App\Transformer\AirportTransformer;
use App\Transformer\FlightSeatTypeTransformer;
use App\Transformer\FlightTransformer;
use PHPUnit\Framework\TestCase;

class FlightTransformerTest extends TestCase
{
    public function testToArray()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();;
        $flightTransformer = $this->createFlightTransformer();
        $result = $flightTransformer->toArray($flight, $seatType->getName());

        $this->assertIsArray($result);
    }

    public function testToArrayList()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();;
        $flightTransformer = $this->createFlightTransformer();
        $result = $flightTransformer->toArrayList([$flight], $seatType->getName());

        $this->assertIsArray($result);
    }

    public function createFlightTransformer()
    {
        $airportRepository = $this->getMockBuilder(AirportRepository::class)->disableOriginalConstructor()->getMock();
        $flightSeatTypeTransformer = $this->getMockBuilder(FlightSeatTypeTransformer::class)->disableOriginalConstructor()->getMock();
        $airlineTransformer = $this->getMockBuilder(AirlineTransformer::class)->disableOriginalConstructor()->getMock();
        $airplaneTransformer = $this->getMockBuilder(AirplaneTransformer::class)->disableOriginalConstructor()->getMock();
        $airportTransformer = $this->getMockBuilder(AirportTransformer::class)->disableOriginalConstructor()->getMock();

        return new FlightTransformer($airportRepository, $flightSeatTypeTransformer,$airlineTransformer, $airplaneTransformer, $airportTransformer);
    }
}
