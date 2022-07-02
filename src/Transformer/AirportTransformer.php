<?php

namespace App\Transformer;

use App\Entity\Airport;

class AirportTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'iata', 'name', 'city'];

    /**
     * @param array $airports
     * @return array
     */
    public function listToArray(array $airports): array
    {
        $data = [];
        foreach ($airports as $airport) {
            $data[] = $this->toArray($airport);
        }

        return $data;
    }

    /**
     * @param Airport $airport
     * @return array
     */
    private function toArray(Airport $airport): array
    {
        $result = $this->transform($airport, self::BASE_ATTRIBUTE);

        return $result;
    }
}
