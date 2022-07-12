<?php

namespace App\Tests\Service;

use App\Entity\Flight;
use App\Entity\FlightSeatType;
use App\Entity\SeatType;
use App\Repository\FlightSeatTypeRepository;
use App\Service\AirplaneSeatTypeService;
use PHPUnit\Framework\TestCase;

class FlightSeatTypeServiceTest extends TestCase
{
    public function testUpdateAvailableSeats()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $flightSeatTypeService = $this->createAirplaneSeatTypeService();
        $result = $flightSeatTypeService->updateAvailableSeats($flight,$seatType, 1);

        $this->assertTrue($result);
    }

    public function createAirplaneSeatTypeService(): AirplaneSeatTypeService
    {
        $flightSeatTypes = $this->getMockBuilder(FlightSeatType::class)->disableOriginalConstructor()->getMock();
        $flightSeatTypRepository = $this->getMockBuilder(FlightSeatTypeRepository::class)->disableOriginalConstructor()->getMock();
        $flightSeatTypRepository->expects($this->any())->method('findBy')->willReturn([$flightSeatTypes]);

        return new AirplaneSeatTypeService($flightSeatTypRepository);
    }
}
{

}
