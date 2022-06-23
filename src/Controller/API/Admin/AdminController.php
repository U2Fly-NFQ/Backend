<?php

namespace App\Controller\API\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/api/admin', name: 'api_admin_index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'status' => 'success',
            'data' => [
                'message' => 'Welcome to API Admin Controller!',
                'path' => 'src/Controller/API/Admin/AdminController.php',
            ]
        ]);
    }
}
