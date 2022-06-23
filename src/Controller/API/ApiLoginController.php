<?php

namespace App\Controller\API;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login_index')]
    public function index(JWTTokenManagerInterface $JWTTokenManager): JsonResponse
    {
        $user = $this->getUser();
        $token = $JWTTokenManager->create($user);

        return $this->json([
            'status' => 'success',
            'data' => [
                'user' => $user->getUserIdentifier(),
                'role' => $user->getRoles(),
                'token' => $token
            ]
        ]);
    }
}
