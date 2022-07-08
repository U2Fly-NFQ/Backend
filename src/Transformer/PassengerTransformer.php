<?php

namespace App\Transformer;

use App\Entity\Passenger;
use App\Traits\DateTimeTrait;

class PassengerTransformer extends AbstractTransformer
{
    use DateTimeTrait;

    const BASE_ATTRIBUTE = ['accountId', 'name', 'gender', 'birthday', 'address', 'identification'];

    public function objectToArray(Passenger $passenger): array
    {
        $result = $this->transform($passenger, self::BASE_ATTRIBUTE);
        $result['accountId'] = $passenger->getId();
        $result['name'] = $passenger->getName();
        $result['gender'] = $passenger->getGender();
        if ($passenger->getBirthday() != null) {
            $result['birthday'] = $this->dateTimeToDate($passenger->getBirthday());
        }
        $result['address'] = $passenger->getAddress();
        $result['identification'] = $passenger->getIdentification();

        return $result;
    }
}
