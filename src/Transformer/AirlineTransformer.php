<?php

namespace App\Transformer;

use App\Entity\Airline;
use PHP_CodeSniffer\Tests\Core\Tokenizer\DoubleArrowTest;

class AirlineTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name', 'icao'];

    /**
     * @param Airline $airline
     * @return array
     */
    public function objectToArray(Airline $airline): array
    {
        $result = $this->transform($airline, self::BASE_ATTRIBUTE);
        $result['createdAt'] = $airline->getCreatedAt()->format(date(DATE_ATOM));
        $result['updatedAt'] = $airline->getUpdatedAt()->format(date(DATE_ATOM));

        return $result;
    }
}
