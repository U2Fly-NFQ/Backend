<?php

namespace App\Tests\Entity;

use App\Entity\Airline;
use App\Entity\Airplane;
use App\Entity\Image;
use DateTime;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AirlineTest extends TestCase
{
    public function testGetId()
    {
        $airline = new Airline();
        $airline->setId(1);
        $result = $airline->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetIcao()
    {
        $airline = new Airline();
        $airline->setIcao('HVN');
        $result = $airline->getIcao();

        $this->assertEquals('HVN', $result);
    }

    public function testGetUpdatedAt()
    {
        $airline = new Airline();
        $date = new DateTime('2022-07-07 16:05:00');
        $airline->setUpdatedAt($date);
        $result = $airline->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetCreatedAt()
    {
        $airline = new Airline();
        $date = new DateTime('2022-07-07 16:05:00');
        $airline->setCreatedAt($date);
        $result = $airline->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetName()
    {
        $airline = new Airline();
        $airline->setName('Bamboo Airways');
        $result = $airline->getName();

        $this->assertEquals('Bamboo Airways', $result);
    }

    public function testGetDeletedAt()
    {
        $airline = new Airline();
        $date = new DateTime('2022-07-07 16:05:00');
        $airline->setDeletedAt($date);
        $result = $airline->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetImage()
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $airline = new Airline();
        $airline->setImage($image);
        $result = $airline->getImage();

        $this->assertEquals($image, $result);
    }

    public function testRating()
    {
        $airline = new Airline();
        $airline->setRating(4);
        $result = $airline->getRating();

        $this->assertEquals(4, $result);
    }

    public function testNumberRating()
    {
        $airline = new Airline();
        $airline->setNumberRating(4);
        $result = $airline->getNumberRating();

        $this->assertEquals(4, $result);
    }

    public function testGetAirplanes()
    {
        $airplane = $this->getMockBuilder(Airplane::class)->disableOriginalConstructor()->getMock();
        $airline = new Airline();
        $airline->addAirplane($airplane);
        $result = $airline->getAirplanes();

        $this->assertInstanceOf(Collection::class, $result);
    }

}
