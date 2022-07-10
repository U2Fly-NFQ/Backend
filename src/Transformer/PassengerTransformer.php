<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Passenger;
use App\Traits\DateTimeTrait;
use DateTime;

class PassengerTransformer extends AbstractTransformer
{
    use DateTimeTrait;

    const BASE_ATTRIBUTE = ['id', 'name', 'gender', 'address', 'identification'];

    /**
     * @param Passenger $passenger
     * @return array
     * @throws \Exception
     */
    public function toArray(Passenger $passenger): array
    {
        $result = $this->transform($passenger, self::BASE_ATTRIBUTE);
        $result['accountId'] = $passenger->getAccount()->getId();
        $result['email'] = $passenger->getAccount()->getEmail();
        $result['birthday'] = new DateTime($this->dateTimeToDate($passenger->getBirthday())) ;

        return $result;
    }
}
