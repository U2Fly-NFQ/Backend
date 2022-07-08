<?php

namespace App\Service;

use App\Constant\ErrorsConstant;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Repository\FlightSeatTypeRepository;
use Exception;

class AirplaneSeatTypeService
{
    private FlightSeatTypeRepository $flightSeatTypeRepository;

    /**
     * @param FlightSeatTypeRepository $airplaneSeatTypeRepository
     */
    public function __construct(FlightSeatTypeRepository $airplaneSeatTypeRepository)
    {
        $this->flightSeatTypeRepository = $airplaneSeatTypeRepository;
    }

    /**
     * @param Flight $flight
     * @param SeatType $seatType
     * @param int $change
     * @return bool
     * @throws Exception
     */
    public function updateAvailableSeats(Flight $flight, SeatType $seatType, int $change): bool
    {
        $seatTypeId = $seatType->getId();
        $flightId = $flight->getId();

        $query = ['flight' => $flightId, 'seatType' => $seatTypeId];
        $airplaneSeatTypes = $this->flightSeatTypeRepository->findBy($query);
        $airplaneSeatType = array_pop($airplaneSeatTypes);
        $seatAvailable = $airplaneSeatType->getSeatAvailable();
        $newSeatAvailable = $seatAvailable + $change;
        if ($newSeatAvailable < 0) {
            throw new Exception(ErrorsConstant::SEAT_NOT_AVAILABLE);
        }
        $airplaneSeatType->setSeatAvailable($newSeatAvailable);
        $this->flightSeatTypeRepository->add($airplaneSeatType, true);

        return true;
    }
}
