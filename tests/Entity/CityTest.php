<?php

namespace App\Tests\Entity;

use App\Entity\Airport;
use App\Entity\City;
use App\Entity\Image;
use DateTime;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    public function testGetId()
    {
        $city = new City();
        $city->setId(1);
        $result = $city->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetName()
    {
        $city = new City();
        $city->setName('Ha Noi');
        $result = $city->getName();

        $this->assertEquals('Ha Noi', $result);
    }

    public function testGetImage()
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $city = new City();
        $city->setImage($image);
        $result = $city->getImage();

        $this->assertEquals($image, $result);
    }

    public function testGetAirport()
    {
        $airport = $this->getMockBuilder(Airport::class)->disableOriginalConstructor()->getMock();
        $city = new City();
        $city->setAirport($airport);
        $result = $city->getAirport();

        $this->assertEquals($airport, $result);
    }

    public function testGetAttractive()
    {
        $city = new City();
        $city->setAttractive(1);
        $result = $city->getAttractive();

        $this->assertEquals(1, $result);
    }

    public function testGetCreatedAd()
    {
        $date = new DateTime('2022-07-09 00:00:00');
        $city = new City();
        $city->setCreatedAt($date);
        $result = $city->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2022-07-09 00:00:00');
        $city = new City();
        $city->setUpdatedAt($date);
        $result = $city->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2022-07-09 00:00:00');
        $city = new City();
        $city->setDeletedAt($date);
        $result = $city->getDeletedAt();

        $this->assertEquals($date, $result);
    }
}
