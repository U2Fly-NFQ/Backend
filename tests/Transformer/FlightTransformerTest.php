<?php

namespace App\Tests\Transformer;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\Airport;
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
//    public function testToArray()
//    {
//        $flight = $this->getMockFlight();
//        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();;
//        $flightTransformer = $this->createFlightTransformer();
//        $result = $flightTransformer->toArray($flight, $seatType->getName());
//
//        $this->assertIsArray($result);
//    }
//
//    public function getMockFlight()
//    {
//        $airport = $this->getMockBuilder(Airport::class)->disableOriginalConstructor()->getMock();
//        $airportRepository = $this->getMockBuilder(AirportRepository::class)->disableOriginalConstructor()->getMock();
//        $airportRepository->expects($this->any())->method('findByIATA')->willReturn('sad');
//        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
//        $airplane = $this->getMockBuilder(Airplane::class)->disableOriginalConstructor()->getMock();
//        $airplane->expects($this->any())->method('getAirline')->willReturn($airline);
//        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
//        $flight->expects($this->any())->method('getAirplane')->willReturn($airplane);
//
//        return $flight;
//    }

//    public function testToArrayList()
//    {
//        $airplane = $this->getMockBuilder(Airplane::class)->disableOriginalConstructor()->getMock();
//        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
//        $flight->expects($this->any())->method('getAirplane')->willReturn($airplane);
//        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();;
//        $flightTransformer = $this->createFlightTransformer();
//        $result = $flightTransformer->toArrayList([$flight], $seatType->getName());
//
//        $this->assertIsArray($result);
//    }

//    public function createFlightTransformer()
//    {
//        $airportRepository = $this->getMockBuilder(AirportRepository::class)->disableOriginalConstructor()->getMock();
//        $flightSeatTypeTransformer = $this->getMockBuilder(FlightSeatTypeTransformer::class)->disableOriginalConstructor()->getMock();
//        $airlineTransformer = $this->getMockBuilder(AirlineTransformer::class)->disableOriginalConstructor()->getMock();
//        $airplaneTransformer = $this->getMockBuilder(AirplaneTransformer::class)->disableOriginalConstructor()->getMock();
//        $airportTransformer = $this->getMockBuilder(AirportTransformer::class)->disableOriginalConstructor()->getMock();
//
//        return new FlightTransformer($airportRepository, $flightSeatTypeTransformer,$airlineTransformer, $airplaneTransformer, $airportTransformer);
//    }
}
