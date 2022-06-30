<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Airline;
use PHP_CodeSniffer\Tests\Core\Tokenizer\DoubleArrowTest;

class AirlineTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name', 'icao', 'avatar'];

    /**
     * @param Airline $object
     * @return array
     */
    public function objectToArray($object): array
    {
        $result = $this->transform($object, self::BASE_ATTRIBUTE);
        $result['createdAt'] = $object->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if(!empty($object->getUpdatedAt())){
            $result['updatedAt'] = $object->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }

        return $result;
    }
}
