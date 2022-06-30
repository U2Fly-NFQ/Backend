<?php

namespace App\Service;

use App\Entity\Flight;
use App\Repository\FlightRepository;
use App\Request\ListFlightRequest;
use App\Traits\ObjectTrait;
use App\Traits\TransferTrait;
use App\Transformer\FlightTransformer;

class FlightService
{
    use ObjectTrait;
    use TransferTrait;

    private FlightRepository $flightRepository;
    private FlightTransformer $flightTransformer;

    public function __construct(FlightRepository $flightRepository, FlightTransformer $flightTransformer)
    {
        $this->flightRepository = $flightRepository;
        $this->flightTransformer = $flightTransformer;
    }

    public function find(ListFlightRequest $listFlightRequest)
    {
        $params = $this->objectToArray($listFlightRequest);
        $flight = new Flight();
        $listFlightParamsArray = $listFlightRequest->transfer($params, $listFlightRequest, $flight);
        $flight = $this->flightRepository->filter($listFlightParamsArray);
        $pagination = [
            'current_page' => $flight['pagination']['current_page'],
            'offset' => $listFlightParamsArray['pagination']['offset'],
            'total' => $flight['pagination']['total']
        ];
        $flightResponse = [
            'data' => $this->flightTransformer->toArrayList($flight['data']),
            'pagination' => $pagination
        ];

        return $flightResponse;
    }
}