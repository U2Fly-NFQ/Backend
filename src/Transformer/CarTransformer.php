<?php

namespace App\Transformer;

use App\Entity\Car;

class CarTransformer
{
    public function objectToArray(Car $car): array
    {
        return [
            'id' => $car->getId(),
            'name'=> $car->getName(),
            'brand' => $car->getBrand(),
            'color' => $car->getColor(),
            'price' => $car->getPrice(),
            'image' => $car->getThumbnail()->getPath(),
            'userCreated' => $car->getCreatedUser()->getName(),
            'description' => $car->getDescription(),
            'seats' => $car->getSeats(),
            'year' => $car->getYear()
        ];
    }

    public function toArray(array $cars): array
    {
        $data = [];
        foreach ($cars as $car) {
            $data[] = $this->objectToArray($car);
        }
        return $data;
    }
}
