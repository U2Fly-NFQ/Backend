<?php

namespace App\Controller\API\Car;

use App\Request\AddCarRequest;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
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
        $errors = $validator->validate($carRequest);
        if (!empty($errors) > 0) {
            throw new ValidatorException("Something got errors in your request!!");
        }
        $car = $carService->add($carRequest);
        $car = $carTransformer->objectToArray($car);

        return $this->success([], Response::HTTP_CREATED);
    }

}
