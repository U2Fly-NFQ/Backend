<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Passenger;
use App\Traits\DateTimeTrait;

class PassengerTransformer extends AbstractTransformer
{
    use DateTimeTrait;

    const BASE_ATTRIBUTE = ['accountId', 'name', 'gender', 'birthday', 'address', 'identification'];

    public function toArray(Passenger $passenger): array
    {
        $result = $this->transform($passenger, self::BASE_ATTRIBUTE);
        $result['accountId'] = $passenger->getId();
        $passenger->getName() == null ? $result['name'] == null : $result['name'] = $passenger->getName();
        $passenger->getGender() == null ? $result['gender'] == null : $result['name'] = $passenger->getGender();
        $passenger->getBirthday() == null ? $result['birthday'] == null : $result['birthday'] = $this->dateTimeToDate($passenger->getBirthday());
        $passenger->getAddress() == null ? $result['address'] == null : $result['address'] = $passenger->getAddress();
        $passenger->getIdentification() == null ? $result['identification'] == null : $result['identification'] = $passenger->getIdentification();
        return $result;
    }
}
