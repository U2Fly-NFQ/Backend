<?php

namespace App\Controller\Image;

use App\Request\ImageRequest;
use App\Service\ImageService;
use App\Traits\JsonTrait;
use App\Transformer\ImageTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_')]
class ImageController
{
    use JsonTrait;

    private ImageTransformer $imageTransformer;

    #[Route('/image', name: 'image', methods: 'POST')]
    public function uploadImage(
        Request            $request,
        ImageRequest       $imageRequest,
        ValidatorInterface $validator,
        ImageService       $imageService,
        ImageTransformer   $imageTransformer
    ): JsonResponse
    {
        $file = $request->files->get('image');
        $imageRequest->setImage($file);
        $errors = $validator->validate($imageRequest);
        if (count($errors) > 0) {
            return $this->error($errors);
        }
        $image = $imageService->upload($file);

        $result = $imageTransformer->objectToArray($image);

        return $this->success($result);
    }

    #[Route('/image/list', name: 'image_list')]
    public function list(
        ImageService     $imageService,
        ImageTransformer $imageTransformer
    ): JsonResponse
    {
        $images = $imageService->listAll();
        $data = $imageTransformer->toArray($images);

        return $this->success($data);
    }
}
