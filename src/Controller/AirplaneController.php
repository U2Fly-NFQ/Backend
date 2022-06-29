<?php

namespace App\Controller;

use App\Repository\AirplaneRepository;
use App\Request\AirplaneRequest;
use App\Traits\JsonTrait;
use App\Transformer\AirplaneTransformer;
use PhpParser\JsonDecoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AirplaneController extends AbstractController
{
    use JsonTrait;

    #[Route('/airplane', name: 'app_list_airplane', methods: 'GET')]
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
