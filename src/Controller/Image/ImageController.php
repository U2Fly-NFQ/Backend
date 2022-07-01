<?php

namespace App\Controller\Image;

use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Service\ImageService;
use App\Traits\JsonTrait;
use App\Transformer\ImageTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/image/{id}', name: 'app_find_by_id_image', methods: 'GET')]
    public function findById(int $id, ImageRepository $imageRepository, ImageTransformer $imageTransformer)
    {
        $image = $imageRepository->find($id);
        if($image == null){
            return $this->error([]);
        }
        $data = $imageTransformer->toArray($image);

        return $this->success($data);
    }

    #[Route('/api/image', name: 'app_upload_image', methods: 'POST')]
    public function upload(Request $request, ImageService $imageService): JsonResponse
    {
        $file = $request->files->get('image');
        $image = $imageService->upLoad($file);

        return $this->success(['Id' => $image->getId()]);
    }
}
