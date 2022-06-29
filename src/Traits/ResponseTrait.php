<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{
    public function success(array $data, string $statusCode): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'data' => $data
        ], $statusCode);
    }

    public function error(array $data, int $statusCode): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'errors' => $data
        ], $statusCode);
    }
}

