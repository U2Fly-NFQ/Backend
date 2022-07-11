<?php

namespace App\Transformer;

class ImageTransformer extends AbstractTransformer
{
    public function objectToArray($image): array
    {
        return [
            'id' => $image->getId(),
            'path' => $image->getPath()
        ];
    }
}
