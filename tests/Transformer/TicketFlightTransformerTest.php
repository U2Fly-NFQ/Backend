<?php

namespace App\Tests\Transformer;

use App\Entity\TicketFlight;
use App\Transformer\FlightTransformer;
use App\Transformer\TicketFlightTransformer;
use PHPUnit\Framework\TestCase;

class TicketFlightTransformerTest extends TestCase
{
    public function testToArray()
    {
        $flightTransformer = $this->getMockBuilder(FlightTransformer::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlightTransformer = new TicketFlightTransformer($flightTransformer);
        $result = $ticketFlightTransformer->toArray($ticketFlight);

        $this->assertIsArray($result);
    }
}
