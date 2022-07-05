<?php

namespace App\Controller\Mail;

use App\Service\MailService;
use App\Traits\JsonTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'mail_')]
class MailController
{
    const HELLO_FILE = __DIR__ . "/../../../public/file/hello.html";

    use JsonTrait;

    #[Route('/mail', name: 'index', methods: 'POST')]
    public function index(MailService $mailService, Request $request)
    {
        $bodyRequest = json_decode($request->getContent(), true);
        $userMail = $bodyRequest['userMail'];
        $name = $bodyRequest['name'];
        $mailService->mail($userMail, self::HELLO_FILE, $name);
        return $this->success([
            'message' => 'Mail sent'
        ]);
    }
}
