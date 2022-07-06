<?php

namespace App\Transformer;

use App\Entity\Car;
use App\Entity\Flight;
use App\Repository\AirplaneSeatTypeRepository;
use App\Repository\AirportRepository;
use App\Traits\DateTimeTrait;
use App\Traits\TransferTrait;

class FlightTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'code', 'arrival', 'departure', 'startTime', 'startDate', 'duration'];
    const AIRLINE_ATTRIBUTE = ['icao'];
    const AIRPLANE_ATTRIBUTE = ['id', 'name'];
    const AIRPORT_ATTRIBUTE = ['iata', 'name', 'city'];
    const SEAT_TYPE_ATTRIBUTE = ['price', 'seatAvailable'];

    use TransferTrait;
    use DateTimeTrait;

    private AirportRepository $airportRepository;
    private AirplaneSeatTypeRepository $airplaneSeatTypeRepository;
    private AirplaneSeatTypeTransformer $airplaneSeatTypeTransformer;
    private AirlineTransformer $airlineTransformer;
    private AirplaneTransformer $airplaneTransformer;
    private AirportTransformer $airportTransformer;

    public function __construct(
        AirportRepository $airportRepository,
        AirplaneSeatTypeTransformer $airplaneSeatTypeTransformer,
        AirlineTransformer $airlineTransformer,
        AirplaneTransformer $airplaneTransformer,
        AirportTransformer $airportTransformer
    ) {
        $this->airportRepository = $airportRepository;
        $this->airplaneSeatTypeTransformer = $airplaneSeatTypeTransformer;
        $this->airlineTransformer = $airlineTransformer;
        $this->airplaneTransformer = $airplaneTransformer;
        $this->airportTransformer = $airportTransformer;
    }

    public function toArrayList(array $flights, string $seatType): array
    {
        $flightList = [];
        foreach ($flights as $key => $flight) {
            $flightList[] = $this->toArray($flight, $seatType);
        }

        return $flightList;
    }

    public function toArray(Flight $flight, $seatType = null): array
    {

        $result = $this->transform($flight, self::BASE_ATTRIBUTE);
        $result['airplane'] = $this->airplaneTransformer->toArray($flight->getAirplane());
        $result['airline'] = $this->airlineTransformer->toArray($flight->getAirplane()->getAirline());
        $result['arrival'] = $this->airportTransformer->toArray($this->airportRepository->findByIATA($flight->getArrival()));
        $result['departure'] = $this->airportTransformer->toArray($this->airportRepository->findByIATA($flight->getDeparture()), self::AIRPORT_ATTRIBUTE);
        $result['startDate'] = $this->dateTimeToDate($flight->getStartDate());
        $result['startTime'] = $this->dateTimeToTime($flight->getStartTime());
        $seats = $flight->getAirplane()->getAirplaneSeatTypes();
        foreach ($seats as $seat) {
            if ($seatType == null) {
                $result['seat'][] = $this->airplaneSeatTypeTransformer->toArray($seat);
            } elseif ($seat->getSeatType() == $seatType) {
                $result['seat'][] = $this->airplaneSeatTypeTransformer->toArray($seat);
            }
        }

        return $result;
    }
}
