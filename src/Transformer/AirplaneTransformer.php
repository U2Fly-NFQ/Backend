<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Airplane;
use App\Traits\TransferTrait;

class AirplaneTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name'];

    use TransferTrait;

    public function toArrayList(array $airplanes): array
    {
        $data = [];
        foreach ($airplanes as $airplane) {
            $data[] = $this->toArray($airplane);
        }

        return $data;
    }

    public function toArray(Airplane $airplane): array
    {
        $result = $this->transform($airplane, self::BASE_ATTRIBUTE);

        return $result;
    }
}
