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

    public function __construct(AirportRepository $airportRepository, AirplaneSeatTypeTransformer $airplaneSeatTypeTransformer)
    {
        $this->airportRepository = $airportRepository;
        $this->airplaneSeatTypeTransformer = $airplaneSeatTypeTransformer;

    }

    public function toArrayList(array $flights, string $seatType): array
    {
        $flightList = [];
        foreach ($flights as $key => $flight) {
            $flightList[] = $this->toArray($flight, $seatType);
        }

        return $flightList;
    }

    public function toArray(Flight $flight): array
    {

        $result = $this->transform($flight, self::BASE_ATTRIBUTE);
        $result['airplane'] = $this->transform($flight->getAirplane(), self::AIRPLANE_ATTRIBUTE);
        $result['airline'] = $this->transform($flight->getAirplane()->getAirline(), self::AIRLINE_ATTRIBUTE);
        $result['arrival'] = $this->transform($this->airportRepository->findByIATA($flight->getArrival()), self::AIRPORT_ATTRIBUTE);
        $result['departure'] = $this->transform($this->airportRepository->findByIATA($flight->getDeparture()), self::AIRPORT_ATTRIBUTE);

        $seats = $flight->getAirplane()->getAirplaneSeatTypes();
        foreach ($seats as $seat) {
            $result['seat'][] = $this->airplaneSeatTypeTransformer->toArray($seat);
        }
        return $result;
    }


}
