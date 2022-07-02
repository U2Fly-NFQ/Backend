<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\File\UploadedFile;
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
    public function getImage(): UploadedFile
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(UploadedFile $image): void
    {
        $this->image = $image;
    }
}
