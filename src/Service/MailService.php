<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailService
{
    const SUPPORT_MAIL_NAME = 'U2Fly Support';
    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function mail($userMail, string $path, $userName = 'User'): void
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = $this->parameterBag->get('zohoHost');
            $mail->SMTPAuth = true;
            $mail->Username = $this->parameterBag->get('zohoMail');
            $mail->Password = $this->parameterBag->get('zohoPassword');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($this->parameterBag->get('zohoMail'), self::SUPPORT_MAIL_NAME);
            $mail->addAddress($userMail, $userName);

            $mail->isHTML(true);
            $mail->Subject = "Successfully payment for $userName";
            $mail->Body = file_get_contents($path);

            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
