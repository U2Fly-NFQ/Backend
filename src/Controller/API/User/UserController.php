<?php

namespace App\Controller\API\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'api_user_index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'status' => 'success',
            'data' => [
                'message' => 'Welcome user to API User Controller!',
                'path' => 'src/Controller/API/User/UserController.php',
            ]
        ]);
    }
}
