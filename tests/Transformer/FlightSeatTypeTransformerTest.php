<?php

namespace App\Tests\Transformer;

use App\Entity\FlightSeatType;
use App\Entity\SeatType;
use App\Transformer\FlightSeatTypeTransformer;
use PHPUnit\Framework\TestCase;

class FlightSeatTypeTransformerTest extends TestCase
{
    public function testToArray()
    {
        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $flightSeatType = $this->getMockBuilder(FlightSeatType::class)->disableOriginalConstructor()->getMock();
        $flightSeatType->expects($this->any())->method('getSeatType')->willReturn($seatType);
        $airplaneSeatTypeTransformer = new FlightSeatTypeTransformer();
        $result = $airplaneSeatTypeTransformer->toArray($flightSeatType);

        $this->assertIsArray($result);
    }
}
