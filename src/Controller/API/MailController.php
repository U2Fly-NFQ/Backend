<?php

namespace App\Controller\API;

use App\Service\MailService;
use App\Traits\JsonResponseTrait;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'mail_')]
class MailController
{
    use JsonResponseTrait;

    #[Route('/mail', name: 'index')]
    public function index(MailService $mailService)
    {
        $mailService->mail();
        return $this->success([
            'message'=>'Mail sent'
        ]);
    }
}
