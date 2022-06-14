<?php

namespace App\Controller\API\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiAdminController extends AbstractController
{
    #[Route('/api/admin', name: 'api_admin_index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to API Admin Controller!',
            'path' => 'src/Controller/API/Admin/ApiAdminController.php',
        ]);
    }
}
