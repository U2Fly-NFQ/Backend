<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Account;

class AccountTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'email'];
    const PASSENGER_ATTRIBUTE = ['id', 'name', 'gender', 'address', 'identification'];

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
        $result['image'] = $account->getImage()->getPath();
        $passenger = $this->transform($account->getPassenger(), self::PASSENGER_ATTRIBUTE);
        $passenger['birthday'] = $account->getPassenger()->getBirthday()->format(DatetimeConstant::DATETIME_DEFAULT);
        return array_merge($result, $passenger);
    }
}
