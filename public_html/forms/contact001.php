<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<?php


$captcha = $_POST['g-recaptcha-response'];

if (!is_null($captcha)) {
    $res = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lffjp0hAAAAAP2Cy0Cy_gnCzV84eNZ7JvlDExKA&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
    if ($res->success === true) {
        //CAPTCHA validado!!!
        //echo 'Tudo certo =)';
    } else {
        echo "<script>alert('Erro ao validar o captcha!!!');window.location.assign('../index.html');</script>";
    }
} else {
    echo 'Captcha não preenchido!';
}



// Criando nossas variáveis para guardar as informações do formulário

//$nome=$_POST['name'];
//$email=$_POST['email'];
// $subject=$_POST['subject'];
// $msg=$_POST['body'];

if (isset($_POST['body']) && !empty($_POST['body'])) {
    $msg = $_POST['body'];
}
if (isset($_POST['subject']) && !empty($_POST['subject'])) {
    $subject = $_POST['subject'];
}
if (isset($_POST['name']) && !empty($_POST['name'])) {
    $nome = $_POST['name'];
}
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
}


// formatando nossa mensagem (que será envaida ao e-mail)

$mensagem = 'Esta mensagem foi enviada através do formulário<br><br>';
$mensagem .= '<b>Nome: </b>' . $nome . '<br>';
$mensagem .= '<b>E-Mail:</b> ' . $email . '<br>';
$mensagem .= '<b>Assunto:</b> ' . $subject . '<br>';
$mensagem .= '<b>Mensagem:</b><br> ' . $msg;
// abaixo as requisições do arquivo phpmailer
require("src/PHPMailer.php");
require("src/SMTP.php");
require("src/Exception.php");

// chamando a função do phpmailer

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->SMTPDebug = 0; // Enable verbose debug output
//$mail->Debugoutput = 'html';
$mail->isSMTP(); // Não modifique
$mail->Host       = 'smtp.gmail.com';  // SEU HOST (HOSPEDAGEM)
$mail->SMTPAuth   = true;                        // Manter em true
$mail->Username   = 'rodrigo.costa764@gmail.com';   //SEU USUÁRIO DE EMAIL
$mail->Password   = 'eqbscpywanbvkdpo';                   //SUA SENHA DO EMAIL SMTP password
$mail->SMTPSecure = 'ssl';    //TLS OU SSL-VERIFICAR COM A HOSPEDAGEM
$mail->Port       = 465;     //TCP PORT, VERIFICAR COM A HOSPEDAGEM
$mail->CharSet = 'UTF-8';    //DEFINE O CHARSET UTILIZADO

//Recipients
$mail->setFrom('rodrigo.costa764@gmail.com', 'Site Rodrigo Costa');  //DEVE SER O MESMO EMAIL DO USERNAME
$mail->addAddress('contato@rodrigocosta-dev.com');     // QUAL EMAIL RECEBERÁ A MENSAGEM!
$mail->addAddress('contato.rodrigocosta.dev@gmail.com');    // VOCÊ pode incluir quantos receptores quiser
$mail->addReplyTo($email, $nome);  //AQUI SERA O EMAIL PARA O QUAL SERA RESPONDIDO                  
// $mail->addCC('cc@example.com'); //ADICIONANDO CC
// $mail->addBCC('bcc@example.com'); //ADICIONANDO BCC

// Attachments
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

// Content
$mail->isHTML(true);
$mail->msgHTML(file_get_contents('../index.html'), dirname(__FILE__));      // Set email format to HTML
$mail->Subject = 'Formulario Contato'; //ASSUNTO
$mail->Body    = $mensagem;  //CORPO DA MENSAGEM
$mail->AltBody = $mensagem;  //CORPO DA MENSAGEM EM FORMA ALT



$mail->send();
if (!$mail->Send()) {
    echo "<script>alert('Erro ao enviar o E-Mail');window.location.assign('../index.html');</script>";
} else {
    echo "<script>alert('Obrigado!!! E-Mail enviado com sucesso!');window.location.assign('../index.html');</script>";
}
die;






?>
