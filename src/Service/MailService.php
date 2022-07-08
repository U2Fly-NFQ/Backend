<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailService
{
    const SUPPORT_MAIL_NAME = 'U2Fly Support';
    private ContainerBagInterface $containerBag;

    public function __construct(ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
    }

    public function mail($userMail, $userName, $contain): void
    {
        $mail = new PHPMailer(true);

        $topic = $contain['topic'];
        $body = $contain['body'];
        $totalPrice = $contain['totalPrice'];
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = $this->containerBag->get('zohoHost');
            $mail->SMTPAuth = true;
            $mail->Username = $this->containerBag->get('zohoMail');
            $mail->Password = $this->containerBag->get('zohoPassword');
            $mail->SMTPSecure = PHPMAILER::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($this->containerBag->get('zohoMail'), self::SUPPORT_MAIL_NAME);
            $mail->addAddress($userMail, $userName);

            $mail->isHTML(false);
            $mail->Subject = $topic . $userName;
            $mail->Body = $body.$totalPrice;
            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
