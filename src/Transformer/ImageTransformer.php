<?php

namespace App\Transformer;

use App\Entity\Image;

class ImageTransformer extends BaseTransformer
{
    public function objectToArray(Image $image): array
    {
        return [
            'id'=>$image->getId(),
            'path'=>$image->getPath()
        ];
    }
}
