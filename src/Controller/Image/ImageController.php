<?php

namespace App\Controller\Image;

use App\Service\ImageService;
use App\Traits\JsonTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/image', name: 'app_upload_image', methods: 'POST')]
    public function index(Request $request, ImageService $imageService): JsonResponse
    {
        $file = $request->files->get('image');
        $image = $imageService->upLoad($file);

        return $this->success(['Id' => $image->getId()]);
    }
}
