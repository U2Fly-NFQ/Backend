<?php

namespace App\Controller\User;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/profile', name:'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user/index.html.twig',[
            'user'=>$user
        ]);
    }
}