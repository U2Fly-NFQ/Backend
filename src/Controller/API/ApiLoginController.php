<?php

namespace App\Controller\API;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
