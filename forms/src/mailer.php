<?php

if(isset($_POST['email'])){

$Asunto = $_POST['Asunto'];
$name = $_POST['fullname'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'rodrigo.costa764@gmail.com';                 // SMTP username
    $mail->Password = 'Ariane1983';                           // SMTP password
    $mail->SMTPSecure = 'SSL';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($email);
    $mail->addAddress('rodrigo.costa764@gmail.com', 'client');     // Add a recipient
    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Asunto;
    $mail->Body    = $mensaje;


    $mail->send();
    echo 'El mensaje se envio de manera exitosa';
} catch (Exception $e) {
    echo 'No se pudo enviar el correo: ', $mail->ErrorInfo;
}}

else
{
	echo "mensaje no enviado";
}

?>