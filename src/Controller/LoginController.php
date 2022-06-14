<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login_index')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/login_handle', name: 'login_handle')]
    public function handleLogin(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirect('/admin');
        }
        return $this->redirect('/profile');
    }

    #[Route('/logout', name: 'logout',methods: ['POST'])]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
