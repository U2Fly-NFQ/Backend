<?php

namespace App\Transformer;

use App\Entity\Image;

class ImageTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'path'];

    public function toArray(Image $image): array
    {
        return $this->transform($image, self::BASE_ATTRIBUTE);
    }
}
