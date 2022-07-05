<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailService
{
    const SUPPORT_MAIL_NAME = 'NTS Support';
    private ContainerBagInterface $containerBag;

    public function __construct(ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
    }

    public function mail($userMail, string $path, $userName = 'User'): void
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = $this->containerBag->get('zohoHost');
            $mail->SMTPAuth = true;
            $mail->Username = $this->containerBag->get('zohoMail');
            $mail->Password = $this->containerBag->get('zohoPassword');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($this->containerBag->get('zohoMail'), self::SUPPORT_MAIL_NAME);
            $mail->addAddress($userMail, $userName);

            $mail->isHTML(true);
            $mail->Subject = "Hello $userName";
            $mail->Body = file_get_contents($path);
            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
