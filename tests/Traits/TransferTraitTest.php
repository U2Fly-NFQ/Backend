<?php

namespace App\Tests\Traits;

use App\Entity\Airport;
use App\Traits\ObjectTrait;
use App\Traits\TransferTrait;
use PHPUnit\Framework\TestCase;

class TransferTraitTest extends TestCase
{
    use TransferTrait;

    public function testGetPropertyOfObject()
    {
        $airport = new Airport();
        $airport->setName('Can Tho');
        $airport->setCity('VCA');
        $result = $this->objectToArray($airport);
        $expected = 'Can Tho';

        $this->assertEquals($result['name'], $expected);
    }
}