<?php

namespace App\Tests\Request;

use App\Request\AddTicketRequest;
use PHPUnit\Framework\TestCase;

class AddTicketRequestTest extends TestCase
{
    public function testGetPassengerId()
    {
        $addTicketRequest = new AddTicketRequest();
        $addTicketRequest->setPassengerId(1);
        $result = $addTicketRequest->getPassengerId();
    }
}
