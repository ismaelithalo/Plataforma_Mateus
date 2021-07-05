<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//Envio de email
function envio($email, $pass, $port, $host,$nome,$email_user,$texto)
{
    $email_user = $_SESSION['UsuarioEmail'];
    $user = $_SESSION['UsuarioNome'];
    $sistema = $_SESSION['selec'];
    $mail = new PHPMailer(true);
    try {
        $name = 'MSO Info Tecnologia - Contato';
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $pass;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = $port;

        $mail->setFrom($email, $name);
        $mail->addAddress($email_user, $user);
        
        $mail->isHTML(true);
        $mail->Subject = 'Contato: Mensagem de $nome';
        $mail->Body    = 'Mensagem enviada por '.$nome.' <br/>E-mail para contato: '.$email.'<br/><br/>Mensagem:<br/>   '.$texto;
        $mail->send();
    } catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
