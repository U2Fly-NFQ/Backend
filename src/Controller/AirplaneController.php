<?php

namespace App\Controller;

use App\Repository\AirplaneRepository;
use App\Traits\JsonTrait;
use App\Transformer\AirplaneTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AirplaneController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/airplanes', name: 'app_list_airplane', methods: 'GET')]
    public function list(AirplaneRepository $airplaneRepository, AirplaneTransformer $airplaneTransformer): JsonResponse
    {
        $airplanes = $airplaneRepository->findAll();
        $data = [];
        foreach ($airplanes as $airplane) {
            array_push($data, $airplaneTransformer->objectToArray($airplane));
        }

        return $this->success($data);
    }
}
