<?php

namespace App\Transformer;

class ImageTransformer extends AbstractTransformer
{
    /**
     * @param $image
     * @return array
     */
    public function toArray($image): array
    {
        return [
            'id' => $image->getId(),
            'path' => $image->getPath()
        ];
    }
}
