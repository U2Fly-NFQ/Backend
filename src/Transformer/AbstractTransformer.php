<?php

namespace App\Transformer;

use App\Entity\AbstractEntity;
use App\Traits\TransferTrait;

class AbstractTransformer
{
    use TransferTrait;

    public function transform(AbstractEntity $entity, array $params)
    {
        $result = [];
        foreach ($params as $key => $value) {
            $action = 'get' . ucfirst($value);
            if (!method_exists($entity, $action)) {
                continue;
            }
            $result[$value] = $entity->{$action}();
        }

        return $result;
    }
}
