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

    public function __construct(
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
        $listFlightRequestParam = $listFlightRequest->splitOneWayAndRoundTrip($listFlightRequest->transfer($listFlightRequest));
        $flightList = [];
        $flightList['oneway'] = [];
        $flightList['roundtrip'] = [];
        $seatTypeOneWay = $listFlightRequest->getSeatType();
        $seatTypeRoundTrip = $listFlightRequest->getSeatTypeRoundTrip();
        $flightList['oneway']['pagination'] = $this->flightRepository->pagination($listFlightRequestParam['criteria']['oneway']);
        $flights['oneway']['flight'] = $this->flightRepository->limit($listFlightRequestParam['criteria']['oneway']['pagination']['page'], $listFlightRequestParam['criteria']['oneway']['pagination']['offset']);
        $flightList['oneway'] = $this->getFlightData($flights, $seatTypeOneWay, 'oneway');

        if ($listFlightRequestParam['criteria']['roundtrip']['arrival'] != null ?? $listFlightRequestParam['criteria']['roundtrip']['departure'] != null) {
            $flightList['roundtrip']['pagination'] = $this->flightRepository->pagination($listFlightRequestParam['criteria']['roundtrip']);
            $flights['roundtrip']['flight'] = $this->flightRepository->limit($listFlightRequestParam['criteria']['roundtrip']['pagination']['page'], $listFlightRequestParam['criteria']['roundtrip']['pagination']['offset']);
            $flightList['roundtrip'] = $this->getFlightData($flights, $seatTypeRoundTrip, 'roundtrip');
        }

        return $flightList;
    }

    public function getFlightData($flights, $seatType, $typeOfFlight)
    {
        $flightList = [];
        foreach ($flights[$typeOfFlight]['flight'] as $key => $flight) {
            $flightList['flight'][] = $this->flightTransformer->toArray($flight);
            $seat = $this->airplaneSeatTypeRepository->getSeatType($flight->getAirplane()->getId(), $seatType);
            $flightList['flight'][$key]['seat'] = $this->airplaneSeatTypeTransformer->toArray($seat);
        }

        return $flightList;
    }
}
