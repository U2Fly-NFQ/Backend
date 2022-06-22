<?php

namespace App\Service;

use App\Entity\Image;
use App\Manager\FileManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    private FileManager $fileManager;

    public function __construct(
        FileManager $fileManager
    )
    {
        $this->fileManager = $fileManager;
    }

    public function upload(UploadedFile $file)
    {
        $image = new Image();
        $imagePath = $this->fileManager->localUpload($file);
    }
}
