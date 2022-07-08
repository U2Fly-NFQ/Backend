<?php

namespace App\Controller\Image;

use App\Request\ImageRequest;
use App\Service\ImageService;
use App\Traits\JsonTrait;
use App\Transformer\ImageTransformer;
use App\Validation\RequestValidation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_')]
class ImageController
{
    use JsonTrait;

    /**
     * @throws \Exception
     */
    #[Route('/image', name: 'image', methods: 'POST')]
    public function uploadImage(
        Request $request,
        ImageRequest $imageRequest,
        ImageService $imageService,
        ImageTransformer $imageTransformer,
        RequestValidation $requestValidation
    ): JsonResponse {
        $file = $request->files->get('image');
        $imageRequest->setImage($file);
        $requestValidation->validate($imageRequest);
        $image = $imageService->upload($file);
        $result = $imageTransformer->toArray($image);

        return $this->success($result);
    }

    #[Route('/image/list', name: 'image_list')]
    public function list(
        ImageService $imageService,
        ImageTransformer $imageTransformer
    ): JsonResponse {
        $images = $imageService->listAll();
        $data = $imageTransformer->toArray($images);

        return $this->success($data);
    }
}
