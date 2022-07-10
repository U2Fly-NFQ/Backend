<?php

namespace App\Tests\Entity;

use App\Entity\Airport;
use App\Entity\City;
use App\Entity\Image;
use DateTime;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AirportTest extends TestCase
{
    public function testGetId()
    {
        $airport = new Airport();
        $airport->setId(1);
        $result = $airport->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetIata()
    {
        $airport = new Airport();
        $airport->setIata('HAN');
        $result = $airport->getIata();

        $this->assertEquals('HAN', $result);
    }

    public function testGetName()
    {
        $airport = new Airport();
        $airport->setName('Noi Bai International Airport');
        $result = $airport->getName();

        $this->assertEquals('Noi Bai International Airport', $result);
    }

    public function testGetCity()
    {
        $airport = new Airport();
        $airport->setCity('Ha Noi');
        $result = $airport->getCity();

        $this->assertEquals('Ha Noi', $result);
    }

    public function testGetImage()
    {
        $image =$this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $airport = new Airport();
        $airport->setImage($image);
        $result = $airport->getImage();

        $this->assertEquals($image, $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2020-07-07 16:20:00');
        $airport = new Airport();
        $airport->setCreatedAt($date);
        $result = $airport->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2020-07-07 16:20:00');
        $airport = new Airport();
        $airport->setUpdatedAt($date);
        $result = $airport->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2020-07-07 16:20:00');
        $airport = new Airport();
        $airport->setDeletedAt($date);
        $result = $airport->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetCities()
    {
        $city = $this->getMockBuilder(City::class)->disableOriginalConstructor()->getMock();
        $airport = new Airport();
        $airport->addCity($city);
        $result = $airport->getCities();

        $this->assertInstanceOf(Collection::class, $result);
    }
}
