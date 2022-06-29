<?php

namespace App\EventListener;

use App\Traits\JsonTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;

class ExceptionListener
{
    use JsonTrait;
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof UnauthorizedHttpException) {
            $response = $this->failed($exception->getMessage(), $exception->getStatusCode());
        } else if ($exception instanceof ValidatorException) {
            $response = $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } else if ($exception instanceof HttpExceptionInterface) {
            $response = $this->failed($exception->getMessage(), $exception->getStatusCode());
        } else {
            $response = $this->failed($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $event->setResponse($response);
    }
}
