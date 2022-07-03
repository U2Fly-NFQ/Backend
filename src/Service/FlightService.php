<?php

namespace App\Service;

use App\Entity\Flight;
use App\Repository\AirplaneSeatTypeRepository;
use App\Repository\FlightRepository;
use App\Request\ListFlightRequest;
use App\Traits\ObjectTrait;
use App\Traits\TransferTrait;
use App\Transformer\AirplaneSeatTypeTransformer;
use App\Transformer\FlightTransformer;

class FlightService
{
    use ObjectTrait;
    use TransferTrait;

    private FlightRepository $flightRepository;
    private FlightTransformer $flightTransformer;
    private AirplaneSeatTypeTransformer $airplaneSeatTypeTransformer;
    private AirplaneSeatTypeRepository $airplaneSeatTypeRepository;

    public function __construct
    (
        FlightRepository            $flightRepository,
        FlightTransformer           $flightTransformer,
        AirplaneSeatTypeRepository  $airplaneSeatTypeRepository,
        AirplaneSeatTypeTransformer $airplaneSeatTypeTransformer
    )
    {
        $this->flightRepository = $flightRepository;
        $this->flightTransformer = $flightTransformer;
        $this->airplaneSeatTypeRepository = $airplaneSeatTypeRepository;
        $this->airplaneSeatTypeTransformer = $airplaneSeatTypeTransformer;
    }

    public function find(ListFlightRequest $listFlightRequest)
    {
        $listFlightRequestParam = $listFlightRequest->transfer($listFlightRequest);
        $flightList = [];
        $flightList['pagination'] = $this->flightRepository->pagination($listFlightRequestParam);
        $flights = $this->flightRepository->limit($listFlightRequestParam['pagination']['page'], $listFlightRequestParam['pagination']['offset']);

        if (empty($flights)) {
            return $flightList;
        }

        $seatType = $listFlightRequest->getSeatType();
        $flightList['flight'] = [];
        foreach ($flights as $key => $flight) {
            $flightList['flight'][] = $this->flightTransformer->toArray($flight);
            $seat = $this->airplaneSeatTypeRepository->getSeatType($flight->getAirplane()->getId(), $seatType);
            $flightList['flight'][$key]['seat'] = $this->airplaneSeatTypeTransformer->toArray($seat);
        }

        return $flightList;
    }
}

