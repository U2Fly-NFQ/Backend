<?php

namespace App\Tests\Transformer;

use App\Entity\Image;
use App\Transformer\ImageTransformer;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class ImageTransformerTest extends TestCase
{
    /**
     * @dataProvider toArrayDataProvider
     * @return void
     */
    public function testToArray($param)
    {
        $imageTransformer = new ImageTransformer();
        $result = $imageTransformer->objectToArray($param);

        $this->assertIsArray($result);
    }


    #[ArrayShape(['happy-case-1' => "\App\Entity\Image[]"])]
    public function toArrayDataProvider(): array
    {
        $image = new Image();
        $image->setPath('google.com');
        $image->setId(1);

        return [
            'happy-case-1'=>[
                'param'=> $image
            ]
        ];
    }
}
