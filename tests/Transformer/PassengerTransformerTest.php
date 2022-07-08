<?php

namespace App\Tests\Transformer;

use App\Entity\Passenger;
use App\Transformer\PassengerTransformer;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class PassengerTransformerTest extends TestCase
{
    /**
     * @dataProvider toArrayDataProvider
     * @return void
     */
    public function testToArray($param): void
    {
        $passengerTransformer = new PassengerTransformer();
        $result = $passengerTransformer->objectToArray($param);

        $this->assertIsArray($result);
    }

    #[ArrayShape(['happy-case-1' => "\App\Entity\Passenger[]"])]
    public function toArrayDataProvider(): array
    {
        $passenger = new Passenger();
        $passenger->setId(1);
        $passenger->setName('Sang');
        $birthDay = new DateTime('2000-01-24 00:00:00');
        $passenger->setBirthday($birthDay);

        return [
          'happy-case-1'=>[
              'param'=>$passenger
          ]
        ];
    }
}
