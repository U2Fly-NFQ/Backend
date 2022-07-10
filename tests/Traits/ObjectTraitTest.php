<?php

namespace App\Tests\Traits;

use App\Entity\Airport;
use App\Traits\ObjectTrait;
use PHPUnit\Framework\TestCase;

class ObjectTraitTest extends TestCase
{
    use ObjectTrait;

    public function testGetPropertyOfObject()
    {
        $airport = new Airport();
        $result = $this->getPropertyOfObject($airport);
        $expected = ['id', 'iata', 'name', 'city', 'image','cities', 'createdAt', 'updatedAt', 'deletedAt'];

        $this->assertEquals($result, $expected);
    }
}