<?php

namespace App\EventListener;

use App\Traits\JsonResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ExceptionListener
{
    use JsonResponseTrait;

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof UnauthorizedHttpException) {
            $response = $this->failed($exception->getMessage(), $exception->getStatusCode());
        }
        else if ($exception instanceof HttpExceptionInterface) {
            $response = $this->failed($exception->getMessage(), $exception->getStatusCode());
        } else {
            $response = $this->failed("Internal error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $event->setResponse($response);
    }
}
