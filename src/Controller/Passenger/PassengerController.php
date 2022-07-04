<?php

namespace App\Controller\Passenger;

use App\Repository\PassengerRepository;
use App\Traits\JsonTrait;
use App\Transformer\PassengerTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_passenger')]
class PassengerController
{
    use JsonTrait;

    #[Route('/passengers/{id}', name: 'find_id', methods: 'GET')]
    public function findById(int $id, PassengerRepository $passengerRepository, PassengerTransformer $passengerTransformer): JsonResponse
    {
        $passenger = $passengerRepository->find($id);
        if ($passenger == null) {
            return $this->error([]);
        }
        $data = $passengerTransformer->toArray($passenger);

        return $this->success($data);
    }

}
