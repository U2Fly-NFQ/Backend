<?php

namespace App\Tests\Transformer;

use App\Entity\Airplane;
use App\Transformer\AirplaneTransformer;
use PHPUnit\Framework\TestCase;

class AirplaneTransformerTest extends TestCase
{
    public function testToArray()
    {
        $airplane = $this->getMockBuilder(Airplane::class)->disableOriginalConstructor()->getMock();
        $airplaneTransformer = new AirplaneTransformer();
        $result = $airplaneTransformer->toArray($airplane);

        $this->assertIsArray($result);
    }

    public function testToArrayList()
    {
        $airplane = $this->getMockBuilder(Airplane::class)->disableOriginalConstructor()->getMock();
        $airplaneTransformer = new AirplaneTransformer();
        $result = $airplaneTransformer->toArrayList([$airplane]);

        $this->assertIsArray($result);
    }
}
