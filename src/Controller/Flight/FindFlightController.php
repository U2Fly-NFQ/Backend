<?php

namespace App\Controller\Flight;

use App\Repository\FlightRepository;
use App\Traits\JsonTrait;
use App\Transformer\FlightTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_flight')]
class FindFlightController
{
    use JsonTrait;

    #[Route('/flights/{id}', name: 'find', methods: 'GET')]
    public function findById(
        int $id,
        FlightRepository $flightRepository,
        FlightTransformer $flightTransformer,
    ): JsonResponse {
        $flight = $flightRepository->find($id);
        if ($flight == null) {
            return $this->error([]);
        }
        $data = $flightTransformer->toArray($flight);

        return $this->success($data);
    }
}
