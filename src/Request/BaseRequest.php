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
        $arr = [];
        $pagination = $this->getPagination($params, $instanceOfRequest);
        $arr['pagination'] = $pagination;

        $propertyOfObject = $this->getPropertyOfObject($instanceOfRequest);
        $criteria = $this->getCriteria($params, $propertyOfObject, $instanceOfRequest);
        $arr['criteria'] = $criteria;
//        $order = $this->getOrder($params);
//        $arr['order'] = $order;
        return $arr;
    }

    private function getCriteria($params, $propertyOfObject, $instanceOfRequest)
    {
        unset($params['page']);
        unset($params['offset']);
        $criteria = [];
        foreach ($params as $key => $value) {
            if (in_array($key, $propertyOfObject)) {
                $getter = 'get' . ucfirst($key);
                $criteria[$key] = $instanceOfRequest->{$getter}($value);
                unset($params[$key]);
            }
        }
        return $criteria;
    }

    private function getPagination($params, $instanceOfRequest)
    {
        $pagination = [];
        $pagination['page'] = $instanceOfRequest->getPage();
        $pagination['offset'] = $instanceOfRequest->getOffset();
        $params['pagination'] = $pagination;
        return $pagination;
    }

    private function getOrder($arr)
    {
        if (!isset($arr['order'])) {
            return $arr;
        }
        $convert_to_array = explode(',', $arr['order']);
        for ($i = 0; $i < count($convert_to_array); $i++) {
            $key_value = explode('.', $convert_to_array [$i]);
            $arr['filterBy'][$key_value [0]] = $key_value [1];
        }

        return $arr['filterBy'];
    }
}
