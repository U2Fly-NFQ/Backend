<?php

namespace App\Controller\Airport;

use App\Repository\AirportRepository;
use App\Traits\JsonTrait;
use App\Transformer\AirportTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AirportController extends AbstractController
{
    use JsonTrait;

    #[Route('api/airports', 'app_list_airport', methods: 'GET')]
    public function list(AirportRepository $airportRepository, AirportTransformer $airportTransformer): JsonResponse
    {
        $airports = $airportRepository->findAll();
        $data = $airportTransformer->listToArray($airports);

        return $this->success($data);
    }
}
