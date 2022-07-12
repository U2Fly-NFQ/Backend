<?php

namespace App\Tests\Service;

use App\Entity\Image;
use App\Manager\FileManager;
use App\Repository\ImageRepository;
use App\Service\ImageService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageServiceTest extends TestCase
{
    public function testUpload()
    {
        $file = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
        $imageService = $this->createImageService();
        $result = $imageService->upload($file);

        $this->assertInstanceOf(Image::class, $result);
    }

    public function testListAll()
    {
        $imageService = $this->createImageService();
        $result = $imageService->listAll();

        $this->assertIsArray($result);
    }

    public function createImageService()
    {
        $fileManager = $this->getMockBuilder(FileManager::class)->disableOriginalConstructor()->getMock();
        $imageRepository = $this->getMockBuilder(ImageRepository::class)->disableOriginalConstructor()->getMock();

        return new ImageService($fileManager, $imageRepository);
    }
}
