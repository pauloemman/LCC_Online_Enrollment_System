<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/src/PHPMailer.php';
require __DIR__ . '/src/SMTP.php';
require __DIR__ . '/src/Exception.php';

function sendMail($to, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // YOUR GMAIL
        $mail->Username = 'paulosernal15@gmail.com';

        // GOOGLE APP PASSWORD
        $mail->Password = 'wkyc eiso djxr apyo
';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(
            'paulosernal15@gmail.com',
            'LCC Online Enrollment'
        );

        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

        return true;

    } catch (Exception $e) {

        return false;
    }
}