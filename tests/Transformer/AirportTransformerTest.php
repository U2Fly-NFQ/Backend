<?php

namespace App\Tests\Transformer;

use App\Entity\Airport;
use App\Entity\Image;
use App\Transformer\AirportTransformer;
use PHPUnit\Framework\TestCase;

class AirportTransformerTest extends TestCase
{
    public function testToArray()
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $airport = $this->getMockBuilder(Airport::class)->disableOriginalConstructor()->getMock();
        $airport->expects($this->any())->method('getImage')->willReturn($image);
        $airportTransformer = new AirportTransformer();
        $result = $airportTransformer->toArray($airport);

        $this->assertIsArray($result);
    }

    public function testToArrayList()
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $airport = $this->getMockBuilder(Airport::class)->disableOriginalConstructor()->getMock();
        $airport->expects($this->any())->method('getImage')->willReturn($image);
        $airportTransformer = new AirportTransformer();
        $result = $airportTransformer->listToArray([$airport]);

        $this->assertIsArray($result);
    }
}
