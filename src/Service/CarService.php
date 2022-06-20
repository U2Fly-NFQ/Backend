<?php

namespace App\Service;

use App\Entity\Car;
use App\Mapper\AddCarRequestToCar;
use App\Repository\CarRepository;
use App\Request\AddCarRequest;
use App\Request\CarRequest;

class CarService
{
    public CarRepository $carRepository;
    public AddCarRequestToCar $addCarRequestToCar;
    public function __construct(CarRepository $carRepository, AddCarRequestToCar $addCarRequestToCar)
    {
        $this->addCarRequestToCar = $addCarRequestToCar;
        $this->carRepository = $carRepository;
    }

    public function findAll(CarRequest $carRequest)
    {
        return $this->carRepository->getAll($carRequest);
    }

    public function add(AddCarRequest $addCarRequest): Car
    {
        $car = $this->addCarRequestToCar->mapper($addCarRequest);
        $this->carRepository->add($car);
        return $car;
    }


}
