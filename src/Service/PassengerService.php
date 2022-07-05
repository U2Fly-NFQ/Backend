<?php

namespace App\Service;

use App\Entity\Passenger;
use App\Repository\PassengerRepository;

class PassengerService
{
    private PassengerRepository $passengerRepository;

    public function __construct(PassengerRepository $passengerRepository)
    {
        $this->passengerRepository = $passengerRepository;
    }

    public function find(Passenger $passenger)
    {
        return $this->passengerRepository->find($passenger);
    }
}
