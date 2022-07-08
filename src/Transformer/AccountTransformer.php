<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Account;

class AccountTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'email'];
    private PassengerTransformer $passengerTransformer;
    public function __construct(PassengerTransformer $passengerTransformer)
    {
        $this->passengerTransformer = $passengerTransformer;
    }

    public function toArrayList(array $accounts): array
    {
        $data = [];
        foreach ($accounts as $account) {
            $data[] = $this->toArray($account);
        }
        return $data;
    }

    public function toArray(Account $account): array
    {
        $result = $this->transform($account, self::BASE_ATTRIBUTE);
        $result['image'] = null;
        $result['email'] = null;
        $passenger = [];
        $account->getImage() == null ? $result['image'] == null : $result['image'] = $account->getImage()->getPath();
        $account->getEmail() == null ? $result['email'] == null : $result['email'] = $account->getEmail();
        $account->getPassenger() == null ? $passenger = [] : $passenger = $this->passengerTransformer->toArray($account->getPassenger());
        return array_merge($result, $passenger);
    }
}
