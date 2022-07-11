<?php

namespace App\Tests\Request\TicketRequest;

use App\Request\TicketRequest\ListTicketRequest;
use PHPUnit\Framework\TestCase;

class ListTicketRequestTest extends TestCase
{
    public function testGetPassenger()
    {
        $listTicketRequest = new ListTicketRequest();
        $listTicketRequest->setPassenger(1);
        $result = $listTicketRequest->getPassenger();

        $this->assertEquals(1, $result);
    }

    public function testIsEffectiveness()
    {
        $listTicketRequest = new ListTicketRequest();
        $listTicketRequest->setEffectiveness(true);
        $result = $listTicketRequest->isEffectiveness();

        $this->assertEquals(1, $result);
    }
}
