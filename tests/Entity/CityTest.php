<?php

namespace App\Tests\Entity;

use App\Entity\City;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    public function testGetId()
    {
        $city = new City();
        $city->setId(1);

    }
}
