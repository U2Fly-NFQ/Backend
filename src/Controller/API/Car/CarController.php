<?php

namespace App\Controller\API\Car;

use App\Entity\Car;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Request\CarRequest;
use Symfony\Component\HttpFoundation\Request;

class CarController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/api/cars', name: 'api_car_index')]
    public function index(
        CarTransformer $carTransformer,
        CarRequest     $carRequest,
        Request        $request,
        CarService     $carService
    ): JsonResponse
    {
        $params = $request->query->all();
        $carData = $carRequest->fromArray($params);
        $cars = $carService->findAll($carData);
        $data = $carTransformer->toArray($cars);

        return $this->success($data);
    }

    #[Route('/api/car/{id}', name: 'api_car_find')]
    public function findById(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $data = [];
        $car = $doctrine->getRepository(Car::class)->find($id);
        if (!$car) {
            throw $this->createNotFoundException(
                'No car found for id ' . $id
            );
        }
        $data[] = $car->getName();

        return $this->success($data);
    }

}
