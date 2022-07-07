<?php

namespace App\Service;

use App\Constant\ErrorsConstant;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Repository\FlightSeatTypeRepository;
use Exception;

class AirplaneSeatTypeService
{
    private FlightSeatTypeRepository $airplaneSeatTypeRepository;

    /**
     * @param FlightSeatTypeRepository $airplaneSeatTypeRepository
     */
    public function __construct(FlightSeatTypeRepository $airplaneSeatTypeRepository)
    {
        $this->airplaneSeatTypeRepository = $airplaneSeatTypeRepository;
    }

    /**
     * @param Flight $flight
     * @param SeatType $seatType
     * @param int $change
     * @return bool
     */
    public function updateAvailableSeats(Flight $flight, SeatType $seatType, int $change): bool
    {
        $airplane = $flight->getAirplane();
        $seatTypeId = $seatType->getId();
        $airplaneId = $airplane->getId();

        $query = ['airplane' => $airplaneId, 'seatType' => $seatTypeId];
        $airplaneSeatTypes = $this->airplaneSeatTypeRepository->findBy($query);
        $airplaneSeatType = array_pop($airplaneSeatTypes);
        $seatAvailable = $airplaneSeatType->getSeatAvailable();
        $newSeatAvailable = $seatAvailable + $change;
        if ($newSeatAvailable < 0) {
            throw new Exception(ErrorsConstant::SEAT_NOT_AVAILABLE);
        }
        $airplaneSeatType->setSeatAvailable($newSeatAvailable);
        $this->airplaneSeatTypeRepository->add($airplaneSeatType, true);

        return true;
    }
}
