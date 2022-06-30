<?php

namespace App\Controller\Airline;

use App\Constant\ErrorsConstant;
use App\Entity\Airline;
use App\Repository\AirlineRepository;
use App\Request\AirlineRequest;
use App\Service\AirlineService;
use App\Traits\JsonTrait;
use App\Transformer\AirlineTransformer;
use App\Transformer\ValidationTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AirlineController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/airlines', 'app_list_airline', methods: 'GET')]
    public function list(AirlineRepository $airlineRepository, AirlineTransformer $airlineTransformer)
    {
        $airlines = $airlineRepository->findAll();
        $data = [];
        foreach ($airlines as $airline) {
            $data[] = $airlineTransformer->objectToArray($airline);
        }

        return $this->success($data);
    }

    #[Route('/api/airlines', 'app_create_airline', methods: 'POST')]
    public function create(Request $request, AirlineRequest $airlineRequest, ValidatorInterface $validator, AirlineService $airlineService, ValidationTransformer $validationTransformer)
    {
        $requestBody = json_decode($request->getContent(), true);
        $airlineRequest = $airlineRequest->fromArray($requestBody);
        $errors = $validator->validate($airlineRequest);
        if(count($errors) > 0){
            $errorsTransformer = $validationTransformer->toArray($errors);

            return $this->error($errorsTransformer);
        }
        $result = $airlineService->addAirline($airlineRequest);

        return $this->success($result);
    }

    #[Route('/api/airlines/{id}', 'app_delete_airline', methods: 'DELETE')]
    public function delete(int $id, AirlineRepository $airlineRepository)
    {
        $airline = $airlineRepository->find($id);
        if (empty($airline)) {
            return $this->failed(ErrorsConstant::AIRPLANE_NOT_FOUND);
        }
        $airlineRepository->remove($airline, true);

        return $this->success([]);
    }
}
