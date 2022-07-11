<?php

namespace App\Tests\Transformer;

use App\Entity\TicketFlight;
use App\Transformer\TicketFlightTransformer;
use PHPUnit\Framework\TestCase;

class TicketFlightTransformerTest extends TestCase
{
    public function testToArray()
    {
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlightTransformer = new TicketFlightTransformer();
        $result = $ticketFlightTransformer->toArray($ticketFlight);

        $this->assertIsArray($result);
    }
}
