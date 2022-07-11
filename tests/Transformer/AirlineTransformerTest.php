<?php

namespace App\Tests\Transformer;

use App\Entity\Airline;
use App\Entity\Image;
use App\Transformer\AirlineTransformer;
use PHPUnit\Framework\TestCase;

class AirlineTransformerTest extends TestCase
{
    public function testToArray()
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $airline->expects($this->any())->method('getImage')->willReturn($image);
        $airlineTransformer = new AirlineTransformer();
        $result = $airlineTransformer->toArray($airline);

        $this->assertIsArray($result);
    }

    public function testToArrayList()
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $airline->expects($this->any())->method('getImage')->willReturn($image);
        $airlineTransformer = new AirlineTransformer();
        $result = $airlineTransformer->toArrayList([$airline]);

        $this->assertIsArray($result);
    }
}
