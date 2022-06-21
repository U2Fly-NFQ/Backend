<?php

namespace App\Controller\API\Car;

use App\Entity\Car;
use App\Request\AddCarRequest;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Request\CarRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    #[IsGranted('ROLE_ADMIN', message: 'get out of here! USER!', statusCode: 403)]
    #[Route('/api/add', name: 'add_car', methods: 'POST')]
    public function addCar(
        Request            $request,
        AddCarRequest      $addCarRequest,
        CarTransformer     $carTransformer,
        CarService         $carService,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $carRequest = $addCarRequest->fromArray($requestBody);
        $error = $validator->validate($carRequest);
        if (count($error) > 0) {
            throw new ValidatorException("Something got errors in your request!!");
        }
        $car = $carService->add($carRequest);
        $car = $carTransformer->objectToArray($car);

        return $this->success($car, Response::HTTP_CREATED);
    }

}
