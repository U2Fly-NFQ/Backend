<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Airline;
use PHP_CodeSniffer\Tests\Core\Tokenizer\DoubleArrowTest;

class AirlineTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name', 'icao'];

    /**
     * @param Airline $object
     * @return array
     */
    public function toArrayList(array $airlines): array
    {
        $data = [];
        foreach ($airlines as $airplane) {
            $data[] = $this->toArray($airplane);
        }

        return $data;
    }

    public function toArray(Airline $airline): array
    {
        $result = $this->transform($airline, self::BASE_ATTRIBUTE);
        $result['createdAt'] = $airline->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if ($airline->getUpdatedAt() != null) {
            $result['updateAt'] = $airline->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }

        return $result;
    }
}
