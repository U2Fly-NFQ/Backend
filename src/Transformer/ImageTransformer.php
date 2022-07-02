<?php

namespace App\Transformer;

use App\Entity\Image;

class ImageTransformer extends AbstractTransformer
{
    public function objectToArray(Image $image): array
    {
        return [
            'id'=>$image->getId(),
            'path'=>$image->getPath()
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
