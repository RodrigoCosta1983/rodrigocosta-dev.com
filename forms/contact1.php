<?php
    // Criando nossas variáveis para guardar as informações do formulário
    $nome=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $msg=$_POST['body'];


    // formatando nossa mensagem (que será envaida ao e-mail)
    $mensagem= 'Esta mensagem foi enviada através do formulário<br><br>';
    $mensagem.='<b>Nome: </b>'.$nome.'<br>';
    $mensagem.='<b>E-Mail:</b> '.$email.'<br>';
    $mensagem.='<b>Assunto</b> '.$subject.'<br>';
    $mensagem.='<b>Mensagem:</b><br> '.$msg;
    
    // abaixo as requisições do arquivo phpmailer
    require("forms/src/PHPMailer.php");
    require("forms/src/SMTP.php");
    require ("forms/src/Exception.php");

    // chamando a função do phpmailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP(); // Não modifique
    $mail->Host       = 'smtp.gmail.com';  // SEU HOST (HOSPEDAGEM)
    $mail->SMTPAuth   = true;                        // Manter em true
    $mail->Username   = 'rodrigo.costa764@gmail.com';   //SEU USUÁRIO DE EMAIL
    $mail->Password   = 'Sophie#1983';                   //SUA SENHA DO EMAIL SMTP password
    $mail->SMTPSecure = 'ssl';    //TLS OU SSL-VERIFICAR COM A HOSPEDAGEM
    $mail->Port       = 465;     //TCP PORT, VERIFICAR COM A HOSPEDAGEM
    $mail->CharSet = 'UTF-8';    //DEFINE O CHARSET UTILIZADO
    
    //Recipients
    $mail->setFrom('rodrigo.costa764@gmail.com', 'Site');  //DEVE SER O MESMO EMAIL DO USERNAME
    $mail->addAddress('rodrigo.costa764@gmail.com');     // QUAL EMAIL RECEBERÁ A MENSAGEM!
    // $mail->addAddress('ellen@example.com');    // VOCÊ pode incluir quantos receptores quiser
    $mail->addReplyTo($email, $nome);  //AQUI SERA O EMAIL PARA O QUAL SERA RESPONDIDO                  
    // $mail->addCC('cc@example.com'); //ADICIONANDO CC
    // $mail->addBCC('bcc@example.com'); //ADICIONANDO BCC

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Mensagem do Formulário'; //ASSUNTO
    $mail->Body    = $mensagem;  //CORPO DA MENSAGEM
    $mail->AltBody = $mensagem;  //CORPO DA MENSAGEM EM FORMA ALT

    // $mail->send();
    if(!$mail->Send()) {
        echo "<script>alert('Erro ao enviar o E-Mail');window.location.assign('index.html');</script>";
     }else{
        echo "<script>alert('E-Mail enviado com sucesso!');window.location.assign('index.html');</script>";
     }
     die
?>
