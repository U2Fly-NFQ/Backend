<?php

namespace App\Transformer;

use App\Entity\AbstractEntity;

class AbstractTransformer
{
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
