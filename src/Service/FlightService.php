<?php

namespace App\Service;


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
        $listFlightRequest->setMinPriceRoundTrip($listFlightRequest->getMinPrice());
        $listFlightRequest->setMaxPriceRoundTrip($listFlightRequest->getMaxPrice());

        $listFlightRequestParam = $listFlightRequest->splitOneWayAndRoundTrip($listFlightRequest->transfer($listFlightRequest));
        $flightList = [];
        $flightList['oneway'] = [];
        $flightList['roundtrip'] = [];
        $seatTypeOneWay = $listFlightRequest->getSeatType();
        $seatTypeRoundTrip = $listFlightRequest->getSeatTypeRoundTrip();
        $flightList['oneway'] = $this->getFlightData($seatTypeOneWay, 'oneway', $listFlightRequestParam);
        if ($listFlightRequestParam['criteria']['roundtrip']['startDate'] == null || empty($flightList['oneway'])) {
            return $flightList;
        }
        $flightList['roundtrip'] = $this->getFlightData($seatTypeRoundTrip, 'roundtrip', $listFlightRequestParam);

        return $flightList;
    }

    public function getFlightData($seatType, $typeOfFlight, $listFlightRequestParam)
    {
        $flightList = [];
        if ($typeOfFlight == 'oneway') {
            $flightList['pagination'] = $this->flightRepository->oneWayPagination($listFlightRequestParam['criteria'][$typeOfFlight]);
            $flights[$typeOfFlight]['flight'] = $this->flightRepository->oneWayLimit(
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['page'],
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['offset']
            );
        } else {
            $flightList['pagination'] = $this->flightRepository->roundTripPagination($listFlightRequestParam['criteria'][$typeOfFlight]);
            $flights[$typeOfFlight]['flight'] = $this->flightRepository->roundTripLimit(
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['page'],
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['offset']
            );
        }

        foreach ($flights[$typeOfFlight]['flight'] as $key => $flight) {
            $flightList['flight'][] = $this->flightTransformer->toArray($flight);
            $seat = $this->airplaneSeatTypeRepository->getSeatType($flight->getAirplane()->getId(), $seatType);
            $flightList['flight'][$key]['seat'] = $this->airplaneSeatTypeTransformer->toArray($seat);
        }

        return $flightList;
    }
}

