<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Passenger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_api_login')]
    public function index(#[CurrentUser] ?Account $account, Security $security): Response
    {
        if (null === $account) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $security->getToken();
        return $this->json([
            'user' => $account->getUsername(),
            'token' => $token,
        ]);
    }
}
