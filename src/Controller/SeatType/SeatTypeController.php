<?php

namespace App\Controller\SeatType;

use App\Entity\SeatType;
use App\Repository\SeatTypeRepository;
use App\Traits\JsonTrait;
use App\Transformer\SeatTypeTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SeatTypeController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/seattype/{id}', name: 'app_seat_type', methods: 'GET')]
    public function findById(int $id, SeatTypeTransformer $seatTypeTransformer, SeatTypeRepository $seatTypeRepository): JsonResponse
    {
        $seatType = $seatTypeRepository->find($id);
        if($seatType == null){
            return $this->error([]);
        }
        $data = $seatTypeTransformer->toArray($seatType);

        return $this->success($data);
    }
}
