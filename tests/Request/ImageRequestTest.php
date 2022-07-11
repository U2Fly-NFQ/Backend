<?php

namespace App\Tests\Request;

use App\Request\ImageRequest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageRequestTest extends TestCase
{
    public function testGetImage()
    {
        $image = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
        $imageRequest = new ImageRequest();
        $imageRequest->setImage($image);
        $result = $imageRequest->getImage();

            $this->assertEquals($image, $result);
    }
}
