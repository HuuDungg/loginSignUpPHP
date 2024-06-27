<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


 function senMailNha($email, $code){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465; // or use 587 with TLS
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl'; // or use 'tls' for port 587

        // Gmail credentials
        $mail->Username = 'sharepage01@gmail.com';
        $mail->Password = 'wvif ezbq saqj dvgg';

        // Sender and recipient settings
        $mail->setFrom('sharepage01@gmail.com');
        $mail->addAddress($email);

        // Email content
        $mail->Subject = 'Verification code';
        $mail->Body    = $code;
        $mail->isHTML(true);

        $mail->send();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
 }


?>
