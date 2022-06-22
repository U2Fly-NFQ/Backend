<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ImageRequest extends BaseRequest
{
    #[Assert\Image(
        maxSize: '4M',
        mimeTypes: ['image/*'],
        mimeTypesMessage: 'Image invalid!!!',
    )]
    private $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

}
