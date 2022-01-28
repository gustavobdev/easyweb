<?php

use CoffeeCode\Router\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Source\Models\Cliente;

$router = new Router(URL_BASE);
if(!isset($_SESSION)){
    session_start();
}

foreach ($data as $key => $value) {
    if (empty($value) or is_null($value)) {
        $_SESSION["decline_newuser"] = "Dados incompletos! por favor adicione todas as informações";
        $router->redirect("console/cria/cliente");
        die();
    }
}

$client = (new Cliente())->find("email = :ema","ema={$data["email"]}")->fetch(true);
if(isset($client)){
    $_SESSION["decline_newuser"] = "O cliente já possui cadastro no sistema!";
    $router->redirect("console/cria/cliente");
    die();
}

$razao = SanitizeSpecialChars($data["razao"]);
$fantasia = SanitizeSpecialChars($data["nome_fantasia"]);
$email = SanitizeEmail($data["email"],"console/cria/cliente");
$phone = phoneValidate($data["phone"], "console/cria/cliente"); 
$celular = phoneValidate($data["celular"], "console/cria/cliente"); 

$client = new Cliente();
$client->razao_social = $razao;
$client->nome_fantasia = $fantasia;
$client->inscricao_estadual = $data["inscricao_estadual"];
$client->cnpj = $data["cnpj"];
$client->contato = $data["contato"];
$client->telefone = $phone;
$client->celular = $celular;
$client->email = $email;
$client->website = $data["site"];
$client->cep = $data["cep"];
$client->rua = $data["rua"];
$client->numero = $data["numero"];
$client->bairro = $data["bairro"];
$client->cidade = $data["cidade"];
$client->estado = $data["estado"];
$client->save();


if($client->save() != false){
    $_SESSION["success_newuser"] = "Cliente {$client->razao_social} criado com sucesso!";
    $router->redirect("/console/clientes");
}else{
    $_SESSION["decline_newuser"] = "Algo deu errado! Revise suas infirmações";
    $router->redirect("console/cria/cliente");
}

//Create a new PHPMailer instance
date_default_timezone_set('America/Sao_Paulo');
$date = date('d/m/Y H:i:s');
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->Username = 'mdmion@gmail.com';
$mail->Password = 'marcelo247867';
$titlemail = utf8_decode("Bem vindo à GBS Rush | $client->first_name");
$mail->AddAddress($client->email , "$titlemail");
$mail->SetFrom("atendimento@softgbs.com", "Gustavo Bomfim");
$mail->Subject = $titlemail;
$content = str_replace(array('%name%', '%lastname%', '%email%', '%password%','%date%'), array($client->first_name, $client->last_name, $client->email, $client->password, $date), file_get_contents('theme/dashboard/mailer/mail.html'));
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/logogbs.jpg", "my-logo");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/facebook-square-white.png", "my-img2");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/instagram-square-white.png", "my-img3");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/linkedin-square-white.png", "my-img4");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/skype-square-white.png", "my-img5");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/slack-square-white.png", "my-img6");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/twitter-square-white.png", "my-img7");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/youtube-square-white.png", "my-img8");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/zoom-square-white.png", "my-img9");
$mail->AddEmbeddedImage("theme/dashboard/mailer/images/87531627391964522.png", "my-img10");
$mail->msgHTML(utf8_decode($content), __DIR__);

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  //  return $router->redirect("/console");
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//echo "<pre>", var_dump($client), "</pre>";

//return $router->redirect("/console");