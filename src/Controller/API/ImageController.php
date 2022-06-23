<?php

namespace App\Controller\API;

use App\Request\ImageRequest;
use App\Service\ImageService;
use App\Traits\JsonResponseTrait;
use App\Transformer\ImageTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_')]
class ImageController
{
    use JsonResponseTrait;

    private ImageTransformer $imageTransformer;

    #[Route('/image', name: 'image', methods: 'POST')]
    public function uploadImage(
        Request            $request,
        ImageRequest       $imageRequest,
        ValidatorInterface $validator,
        ImageService $imageService,
        ImageTransformer $imageTransformer
    ): JsonResponse
    {
        $file = $request->files->get('thumbnail');
        $imageRequest->setImage($file);
        $errors = $validator->validate($imageRequest);
        if (count($errors) > 0) {
            return $this->error($errors);
        }
        $image = $imageService->upload($file);
        $result = $imageTransformer->objectToArray($image);

        return $this->success($result);
    }

}
