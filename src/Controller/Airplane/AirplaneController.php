<?php

namespace App\Controller\Airplane;

use App\Entity\Airplane;
use App\Repository\AirplaneRepository;
use App\Request\ListAirplaneRequest;
use App\Service\AirplaneService;
use App\Traits\JsonTrait;
use App\Transformer\AirplaneTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AirplaneController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/airplanes', name: 'app_list_airplane', methods: 'GET')]
    public function list(Request $request, AirplaneRepository $airplaneRepository, AirplaneTransformer $airplaneTransformer): JsonResponse
    {
        $query = $request->query->all();
        $airplanes = $airplaneRepository->findBy($query);
        $data = $airplaneTransformer->toArrayList($airplanes);
        return $this->success($data);
    }
}
