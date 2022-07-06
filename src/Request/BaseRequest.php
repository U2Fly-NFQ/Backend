<?php

namespace App\Request;

use App\Traits\ObjectTrait;
use App\Traits\TransferTrait;

class BaseRequest
{
    use ObjectTrait;
    use TransferTrait;

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

    public function transfer(BaseRequest $baseRequest): array
    {
        $baseRequestArray = $this->objectToArray($baseRequest);
        $arr = [];
        $arr['criteria'] = $this->getCriteria($baseRequest, $baseRequestArray);
        $arr['order'] = $this->getRequestOrder($baseRequest);
        return $arr;
    }

    private function getCriteria($instanceOfObject, $baseRequest)
    {
        $criteria = [];
        $requestArray = $this->objectToArray($instanceOfObject);
        $params = $this->removeOrderAndPagination($requestArray);
        $propertyOfObject = $this->getPropertyOfObject($instanceOfObject);
        foreach ($params as $key => $value) {
            if (in_array($key, $propertyOfObject)) {
                $getter = 'get' . ucfirst($key);
                $criteria[$key] = $instanceOfObject->{$getter}($value);
                unset($params[$key]);
            }
        }

        return $criteria;
    }

    private function removeOrderAndPagination($request)
    {
        if (!empty($request['order'])) {
            unset($request['order']);
        }
        if (!empty($request['page'])) {
            unset($request['page']);
        }
        if (!empty($request['offset'])) {
            unset($request['offset']);
        }

        return $request;
    }

    private function getRequestOrder($instanceOfRequest): array
    {
        $arr = [];
        if ($instanceOfRequest->getOrder() == null) {
            return [];
        }
        $orderArray = explode(',', $instanceOfRequest->getOrder());

        for ($i = 0; $i < count($orderArray); $i++) {
            $orderItem = explode('.', $orderArray [$i]);
            $arr[$orderItem [0]] = $orderItem [1];
        }

        return $arr;
    }
}
