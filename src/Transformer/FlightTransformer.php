<?php

namespace App\Transformer;

use App\Entity\Car;
use App\Entity\Flight;
use App\Repository\AirplaneSeatTypeRepository;
use App\Repository\AirportRepository;
use App\Traits\TransferTrait;

class FlightTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'code', 'arrival', 'departure', 'startTime', 'duration'];
    const AIRLINE_ATTRIBUTE = ['id', 'name', 'icao'];
    const AIRPLANE_ATTRIBUTE = ['id', 'name'];
    const AIRPORT_ATTRIBUTE = ['iata', 'name', 'city'];
    const SEAT_TYPE_ATTRIBUTE = ['price', 'seatAvailable'];

    use TransferTrait;

    private AirportRepository $airportRepository;
    private AirplaneSeatTypeRepository $airplaneSeatTypeRepository;

    public function __construct(AirportRepository $airportRepository, )
    {
        $this->airportRepository = $airportRepository;

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
        $result['arrival'] = $this->transform($this->airportRepository->findByIATA($result['arrival']), self::AIRPORT_ATTRIBUTE);
        $result['departure'] = $this->transform($this->airportRepository->findByIATA($result['departure']), self::AIRPORT_ATTRIBUTE);
        $airplaneId = $flight->getAirplane()->getAirplaneSeatTypes()[0]->getAirplane()->getId();
//        dd($airplaneId);
//        $seat = $this->airplaneSeatTypeRepository->getSeatType($flightId, $seatType);
//
//        $result['seat'] = $this->transform($seat, self::SEAT_TYPE_ATTRIBUTE);


        return $result;
    }


}
