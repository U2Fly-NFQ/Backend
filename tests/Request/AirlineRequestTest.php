<?php

namespace App\Tests\Request;

use App\Request\AirlineRequest;
use PHPUnit\Framework\TestCase;

class AirlineRequestTest extends TestCase
{
    public function testGetIcao()
    {
        $airlineRequest = new AirlineRequest();
        $airlineRequest->setIcao('HVN');
        $result = $airlineRequest->getIcao();

        $this->assertEquals('HVN', $result);
    }

    public function testGetName()
    {
        $airlineRequest = new AirlineRequest();
        $airlineRequest->setName('Vietnam Airlines');
        $result = $airlineRequest->getName();

        $this->assertEquals('Vietnam Airlines', $result);
    }
}
