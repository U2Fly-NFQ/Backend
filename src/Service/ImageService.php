<?php

namespace App\Service;

use App\Entity\Image;
use App\Manager\FileManager;
use App\Repository\ImageRepository;

class ImageService
{
    private FileManager $fileManager;
    private ImageRepository $imageRepository;

    /**
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager, ImageRepository $imageRepository)
    {
        $this->fileManager = $fileManager;
        $this->imageRepository = $imageRepository;
    }

    public function upLoad($file): Image
    {
        $image = new Image();
        $path = $this->fileManager->upload($file);
        $image->setPath($path);
        $this->imageRepository->add($image, true);

        return $image;
    }
}
