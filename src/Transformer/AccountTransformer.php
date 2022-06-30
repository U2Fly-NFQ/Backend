<?php

namespace App\Transformer;

use App\Entity\Account;

class AccountTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'email'];

    public function toArray(Account $account): array
    {
        $result = $this->transform($account, self::BASE_ATTRIBUTE);
        $result['passengerId'] = $account->getPassenger()->getId();

        return $result;
    }
}
