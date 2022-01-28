<?php

use CoffeeCode\Router\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Source\Models\User;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

foreach ($data as $key => $value) {
    if (empty($value) or is_null($value)) {
        $_SESSION["decline_newuser"] = "Dados incompletos! $key por favor adicione todas as informações";
        $router->redirect("console/cria/usuario");
        die();
    }
}

$user = (new User())->find("email = :ema", "ema={$data["email"]}")->fetch(true);
if (isset($user)) {
    $_SESSION["decline_newuser"] = "O usuário já possui cadastro no sistema!";
    $router->redirect("console/cria/usuario");
    die();
}

$nome = SanitizeSpecialChars($data["nome"]);
$sobrenome = SanitizeSpecialChars($data["sobrenome"]);
$email = SanitizeEmail($data["email"], "console/cria/usuario");
$phone = phoneValidate($data["contato"], "console/cria/usuario");

function generatePassword($qtyCaraceters = 7)
{
    //Letras minúsculas embaralhadas
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

    //Letras maiúsculas embaralhadas
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;

    //Caracteres Especiais
    $specialCharacters = str_shuffle('!@#$%*-');

    //Junta tudo
    $characters = $capitalLetters . $smallLetters . $numbers . $specialCharacters;

    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

    //Retorna a senha
    return $password;
}
$pass = generatePassword();
$user = new User();
$user->nome = $nome;
$user->sobrenome = $sobrenome;
$user->email = $email;
$user->contato = $phone;
$user->password = password_hash($pass, PASSWORD_DEFAULT);
$user->nivel_acesso = $data["tipo"];
$user->save();

if ($user->nivel_acesso == "1") {

    $nlacesso = "Master";
} elseif ($user->nivel_acesso == "2") {

    $nlacesso = "Operacional";
} elseif ($user->nivel_acesso == "3") {
    $nlacesso = "Financeiro";
}


if ($user->save() != false) {

    //Create a new PHPMailer instance
    $mail = getSend();
    $titlemail = utf8_decode("Bem vindo ao Console Transdoni | $user->nome");
    $mail->AddAddress("mdmion@gmail.com", "$titlemail");
    $mail->SetFrom("atendimento@softgbs.com", "Gustavo Bomfim");
    $mail->Subject = $titlemail;
    $content = str_replace(array('%username%', '%nivel%', '%login%', '%password%', '%link%'), array($user->nome . " " . $user->sobrenome, $user->nl_acesso()[0]->desc_acesso, $user->email, $pass, url("login")), file_get_contents('theme/dashboard/mailer/welcomeuser.html'));
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/logotd.png", "my-logo");
    $mail->msgHTML(utf8_decode($content), __DIR__);

    //send the message, check for errors
    if (!$mail->send()) {
        $_SESSION["decline_newuser"] =  'Mailer Error: ' . $mail->ErrorInfo;
        $router->redirect("/console/members");
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $_SESSION["success_newuser"] = "usuário {$user->nome} criado com sucesso com o nivel  {$nlacesso} !";
        $router->redirect("/console/members");
        echo "usuário {$user->nome} criado com sucesso com o nivel  {$nlacesso} !";
    }

    //echo "<pre>", var_dump($user), "</pre>";

}
