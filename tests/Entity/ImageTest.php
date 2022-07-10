<?php

namespace App\Tests\Entity;

use App\Entity\Account;
use App\Entity\Airline;
use App\Entity\Airport;
use App\Entity\Image;
use DateTime;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetId()
    {
        $image = new Image();
        $image->setId(1);
        $result = $image->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetPath()
    {
        $image = new Image();
        $image->setPath('https://wallpaperaccess.com/full/1631415.jpg');
        $result = $image->getPath();

        $this->assertEquals('https://wallpaperaccess.com/full/1631415.jpg', $result);
    }

    public function testGetAccount()
    {
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $image = new Image();
        $image->setAccount($account);
        $result = $image->getAccount();

        $this->assertEquals($account, $result);
    }

    public function testGetAirline()
    {
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $image = new Image();
        $image->setAirline($airline);
        $result = $image->getAirline();

        $this->assertEquals($airline, $result);
    }

    public function testGetAirport()
    {
        $airport = $this->getMockBuilder(Airport::class)->disableOriginalConstructor()->getMock();
        $image = new Image();
        $image->setAirport($airport);
        $result = $image->getAirport();

        $this->assertEquals($airport, $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2022-07-09 17:30:00');
        $image = new Image();
        $image->setCreatedAt($date);
        $result = $image->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2022-07-09 17:30:00');
        $image = new Image();
        $image->setUpdatedAt($date);
        $result = $image->getUpdatedAt();

        $this->assertEquals($date, $result);
    }
}
