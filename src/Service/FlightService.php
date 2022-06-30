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
        $flight = $this->flightRepository->getAll($listFlightRequest);
        $seatType = $listFlightRequest->getSeatType();

        return $this->flightTransformer->toArrayList($flight, $seatType);
    }
}

