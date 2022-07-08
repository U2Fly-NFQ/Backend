<?php

namespace App\Tests\Transformer;

use App\Entity\SeatType;
use App\Transformer\SeatTypeTransformer;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class SeatTypeTransformerTest extends TestCase
{
    /**
     * @dataProvider toArrayDataProvider
     * @param $param
     * @return void
     */
    public function testToArray($param): void
    {
        $seatTypeTransformer = new SeatTypeTransformer();
        $result = $seatTypeTransformer->toArray($param);

        $this->assertIsArray($result);
    }


    #[ArrayShape(['happy-case-1' => "\App\Entity\SeatType[]"])]
    public function toArrayDataProvider(): array
    {
        $seatType = new SeatType();
        $seatType->setId(1);
        $seatType->setName('business');
        $updateTime = new DateTime('2000-01-24 00:00:00');
        $seatType->setUpdatedAt($updateTime);
        return [
            'happy-case-1' => [
                'param'=>$seatType
            ]
        ];
    }
}
