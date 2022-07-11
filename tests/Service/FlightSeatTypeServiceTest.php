<?php

namespace App\Tests\Service;

use App\Entity\Flight;
use App\Entity\SeatType;
use App\Repository\FlightSeatTypeRepository;
use App\Service\FlightSeatTypeService;
use PHPUnit\Framework\TestCase;

class FlightSeatTypeServiceTest extends TestCase
{
    public function testFlightSeatTypeRepository()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $flightSeatTypeService = $this->createAirplaneSeatTypeService();
        $result = $flightSeatTypeService->flightSeatTypeRepository($flight,$seatType, 1);

        $this->assertTrue($result);
    }

    public function createAirplaneSeatTypeService(): FlightSeatTypeService
    {
        $flightSeatTypRepository = $this->getMockBuilder(FlightSeatTypeRepository::class)->disableOriginalConstructor()->getMock();
        return new FlightSeatTypeService($flightSeatTypRepository);
    }
}
