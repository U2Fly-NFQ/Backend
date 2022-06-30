<?php

namespace App\Controller\Flight;

use App\Request\ListFlightRequest;
use App\Service\FlightService;
use App\Traits\ResponseTrait;
use App\Transformer\FlightTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlightController extends AbstractController
{
    use ResponseTrait;

    #[Route('/api/flights', name: 'app_api_flight', methods: 'GET')]
    public function list(
        Request           $request,
        ListFlightRequest $listFlightRequest,
        FlightService     $flightService,
    ): JsonResponse
    {
        $query = $request->query->all();
        $listFlightParams = $listFlightRequest->fromArray($query);
        $flights = $flightService->find($listFlightParams);
        return $this->success($flights, Response::HTTP_OK);
    }
}
