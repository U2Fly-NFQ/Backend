<?php

namespace App\Transformer;

use App\Entity\AbstractEntity;
use Doctrine\Common\Collections\Collection;

class AbstractTransformer
{
    public function transform(AbstractEntity|Collection $entity, array $params)
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
