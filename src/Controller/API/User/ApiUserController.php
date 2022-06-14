<?php

namespace App\Controller\API\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
    #[Route('/api/user', name: 'api_user_index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome user to API User Controller!',
            'path' => 'src/Controller/API/User/ApiUserController.php',
        ]);
    }
}
