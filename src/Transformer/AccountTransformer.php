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

    /**
     * @param array $accounts
     * @return array
     * @throws \Exception
     */
    public function toArrayList(array $accounts): array
    {
        $data = [];
        foreach ($accounts as $account) {
            $data[] = $this->toArray($account);
        }
        return $data;
    }

    /**
     * @param Account $account
     * @return array
     * @throws \Exception
     */
    public function toArray(Account $account): array
    {
        $result = $this->transform($account, self::BASE_ATTRIBUTE);
        $result['image'] = null;
        $result['email'] = null;
        $account->getImage() == null ? $result['image'] == null : $result['image'] = $account->getImage()->getPath();
        $account->getEmail() == null ? $result['email'] == null : $result['email'] = $account->getEmail();
        $account->getPassenger() == null ? $passenger = [] : $passenger = $this->passengerTransformer->toArray($account->getPassenger());

        return array_merge($result, $passenger);
    }
}
