<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    $email_user = $_POST['email_user'];
    $nome = $_POST['nome'];
    $texto = $_POST['texto'];
    
    //Envio de email
    function envio($email, $pass, $port, $host,$nome,$email_user,$texto)
    {
        $mail = new PHPMailer(true);
        try {
            $name = 'MSO Info Tecnologia - Contato';
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = gethostbyname('ssl://smtp.gmail.com');
            // $mail->Host = $host;
            $mail->SMTPAuth = true;
            $mail->Username = $email;
            $mail->Password = $pass;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Port = $port;

            $mail->setFrom($email, $name);
            $mail->addAddress($email, $name);
            
            $mail->isHTML(true);
            $mail->Subject = 'Contato: Mensagem de '.$nome;
            $mail->Body    = 'Mensagem enviada por '.$nome.' <br/>E-mail para contato: '.$email_user.'<br/><br/>Mensagem:<br/>   '.$texto;
            $mail->send();
            header("Location: ../../../?mail=1");
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    
    $email = "ismaelithalo.play@gmail.com";
    $senha = "92992232sg";
    $port = 465;
    $host = "ssl://smtp.gmail.com";
    
    envio($email, $senha, $port, $host, $nome, $email_user, $texto);
   
