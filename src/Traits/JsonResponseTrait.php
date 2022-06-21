<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseTrait
{
    protected function success(array $data, int $status = Response::HTTP_OK, array $header = []): JsonResponse
    {
        $dataResponse = [
            'status' => 'success',
            'data' => $data
        ];
        return new JsonResponse($dataResponse, $status, $header);
    }

    protected function failed(string $message, int $status = Response::HTTP_BAD_REQUEST, array $header = []): JsonResponse
    {
        $dataResponse = [
            'status' => 'failed',
            'data' => $message
        ];
        return new JsonResponse($dataResponse, $status, $header);
    }

    protected function error(string $message, int $status = Response::HTTP_BAD_REQUEST, array $header = []): JsonResponse
    {
        $dataResponse = [
            'status' => 'error',
            'data' => $message
        ];
        return new JsonResponse($dataResponse, $status, $header);
    }
}
