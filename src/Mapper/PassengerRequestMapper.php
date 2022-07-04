<?php

namespace App\Mapper;

use App\Constant\DatetimeConstant;
use App\Entity\Account;
use App\Entity\Passenger;
use App\Request\PassengerRequest\AddPassengerRequest;
use DateTime;

class PassengerRequestMapper extends BaseMapper
{
    public function mapper(AddPassengerRequest $addPassengerRequest, Account $account): Passenger
    {
        $passenger = new Passenger();
        $birthday = Date(DatetimeConstant::DATE_DEFAULT,strtotime($addPassengerRequest->getBirthday()));
        $this->map($passenger, $addPassengerRequest->getName(), 'name');
        $this->map($passenger, $birthday, 'birthday');
        $this->map($passenger, $addPassengerRequest->getAddress(), 'address');
        $this->map($passenger, $addPassengerRequest->getIdentification(), 'identification');
        if($addPassengerRequest->isGender() != null){
            $passenger->setGender($addPassengerRequest->isGender());
        }
        $passenger->setAccount($account);

        return $passenger;
    }
}
