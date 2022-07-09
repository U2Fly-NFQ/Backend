<?php

namespace App\Tests\Request\PassengerRequest;

use App\Request\PassengerRequest\AddPassengerRequest;
use PHPUnit\Framework\TestCase;

class AddPassengerRequestTest extends TestCase
{
    public function testGetName()
    {
        $addPassengerRequest = new AddPassengerRequest();
        $addPassengerRequest->setName('Sang');
        $result = $addPassengerRequest->getName();

        $this->assertEquals('Sang', $result);
    }

    public function testGetGender()
    {
        $addPassengerRequest = new AddPassengerRequest();
        $addPassengerRequest->setGender(false);
        $result = $addPassengerRequest->getGender();

        $this->assertEquals(false, $result);
    }

    public function testGetBirthDay()
    {
        $addPassengerRequest = new AddPassengerRequest();
        $addPassengerRequest->setBirthday('2020-07-07 16:22:00');
        $result = $addPassengerRequest->getBirthday();

        $this->assertEquals('2020-07-07 16:22:00', $result);
    }

    public function testGetAddress()
    {
        $addPassengerRequest = new AddPassengerRequest();
        $addPassengerRequest->setAddress('12 Mau Than');
        $result = $addPassengerRequest->getAddress();

        $this->assertEquals('12 Mau Than', $result);
    }

    public function testGetIdentification()
    {
        $addPassengerRequest = new AddPassengerRequest();
        $addPassengerRequest->setIdentification('235921921');
        $result = $addPassengerRequest->getIdentification();

        $this->assertEquals('235921921', $result);
    }
}
