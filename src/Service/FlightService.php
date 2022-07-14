<?php

namespace App\Service;

use App\Repository\FlightSeatTypeRepository;
use App\Repository\FlightRepository;
use App\Request\ListFlightRequest;
use App\Traits\ObjectTrait;
use App\Traits\TransferTrait;
use App\Transformer\FlightSeatTypeTransformer;
use App\Transformer\FlightTransformer;

class FlightService
{
    use ObjectTrait;
    use TransferTrait;

    private FlightRepository $flightRepository;
    private FlightTransformer $flightTransformer;
    private FlightSeatTypeTransformer $airplaneSeatTypeTransformer;
    private FlightSeatTypeRepository $flightSeatTypeRepository;

    public function __construct(
        FlightRepository          $flightRepository,
        FlightTransformer         $flightTransformer,
        FlightSeatTypeRepository  $flightSeatTypeRepository,
        FlightSeatTypeTransformer $airplaneSeatTypeTransformer
    )
    {
        $this->flightRepository = $flightRepository;
        $this->flightTransformer = $flightTransformer;
        $this->flightSeatTypeRepository = $flightSeatTypeRepository;
        $this->airplaneSeatTypeTransformer = $airplaneSeatTypeTransformer;
    }

    public function find(ListFlightRequest $listFlightRequest)
    {
        $listFlightRequest->setMinPriceRoundTrip($listFlightRequest->getMinPrice());
        $listFlightRequest->setMaxPriceRoundTrip($listFlightRequest->getMaxPrice());

        $listFlightRequestParam = $listFlightRequest->splitOneWayAndRoundTrip($listFlightRequest->transfer($listFlightRequest));
        if ($listFlightRequestParam['criteria']['roundtrip']['startDate']) {
            $listFlightRequestParam['criteria']['roundtrip']['arrival'] = $listFlightRequestParam['criteria']['oneway']['departure'];
            $listFlightRequestParam['criteria']['roundtrip']['departure'] = $listFlightRequestParam['criteria']['oneway']['arrival'];
        }

        $flightList = [];
        $flightList['oneway'] = [];
        $flightList['roundtrip'] = [];
        $seatTypeOneWay = $listFlightRequest->getSeatType();
        $seatTypeRoundTrip = $listFlightRequest->getSeatTypeRoundTrip();
        $flightList['oneway'] = $this->getFlightData($seatTypeOneWay, 'oneway', $listFlightRequestParam);
        if (
            $listFlightRequestParam['criteria']['roundtrip']['startDate'] == null || $flightList['oneway']['pagination']['total'] == 0
        ) {
            $flightList['roundtrip'] = [];
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
            $flights['flight'] = $this->flightRepository->oneWayLimit(
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['page'],
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['offset']
            );
        } else {
            $flightList['pagination'] = $this->flightRepository->roundTripPagination($listFlightRequestParam['criteria'][$typeOfFlight]);
            $flights['flight'] = $this->flightRepository->roundTripLimit(
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['page'],
                $listFlightRequestParam['criteria'][$typeOfFlight]['pagination']['offset']
            );
        }
        foreach ($flights['flight'] as $key => $flight) {
            $flightList['flight'][] = $this->flightTransformer->toArray($flight);
            $seat = $this->flightSeatTypeRepository->getSeatType($flight->getId(), $seatType);
            $flightList['flight'][$key]['seat'] = $this->airplaneSeatTypeTransformer->toArray($seat);

        }
        return $flightList;
    }
}
