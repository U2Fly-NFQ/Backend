<?php

namespace App\Request;

use App\Traits\ObjectTrait;

class BaseRequest
{
    use ObjectTrait;

    public function fromArray(array $query)
    {
        foreach ($query as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (!method_exists($this, $setter) || $value == '') {
                continue;
            }
            $this->{$setter}($value);
        }

        return $this;
    }

    public function transfer(array $params, mixed $instanceOfRequest, mixed $baseObject): array
    {
        $propertyOfObject = $this->getPropertyOfObject($baseObject);
        $arr = [];
        $criteria = [];
        foreach ($params as $key => $value) {
            if (in_array($key, $propertyOfObject)) {
                $getter = 'get' . ucfirst($key);
                $criteria[$key] = $instanceOfRequest->{$getter}($value);
                unset($params[$key]);
            }
        }
        $arr['criteria'] = $criteria;
        if(!isset($params['order'])){
            return $arr;
        }
        $convert_to_array = explode(',', $params['order']);
        for ($i = 0; $i < count($convert_to_array); $i++) {
            $key_value = explode('.', $convert_to_array [$i]);
                $arr['filterBy'][$key_value [0]] = $key_value [1];
        }

        return $arr;
    }
}

