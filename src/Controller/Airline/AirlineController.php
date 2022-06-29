<?php

namespace App\Controller\Airline;

use App\Repository\AirlineRepository;
use App\Traits\JsonTrait;
use App\Transformer\AirlineTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
