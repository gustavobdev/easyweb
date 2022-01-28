<?php

use CoffeeCode\Router\Router;
use Source\Models\Banco;
use Source\Models\Motorista;


$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

foreach ($data as $key => $value) {
    if (empty($value) or is_null($value)) {
        $_SESSION["decline_newdriver"] = "Dados incompletos! Por favor adicione todas as informações";
        $router->redirect("console/motoristas");
        die();
    }
}

$memail = (new Motorista())->find("email = :ema", "ema={$data["email"]}")->fetch(true);
$mcpf = (new Motorista())->find("cpf = :cpf", "cpf={$data["cpf"]}")->fetch(true);
$mrg = (new Motorista())->find("rg = :rrg", "rrg={$data["rg"]}")->fetch(true);
$mcnh = (new Motorista())->find("cnh = :cnh", "cnh={$data["cnh"]}")->fetch(true);

if (isset($memail)) {
    $_SESSION["decline_newdriver"] = "Este EMAIL já possui cadastro no sistema!";
    $router->redirect("console/motoristas");
    die();
} elseif (isset($mcpf)) {
    $_SESSION["decline_newdriver"] = "Este CPF já possui cadastro no sistema!";
    $router->redirect("console/motoristas");
    die();
} elseif (isset($mrg)) {
    $_SESSION["decline_newdriver"] = "Este RG já possui cadastro no sistema!";
    $router->redirect("console/motoristas");
    die();
} elseif (isset($mcnh)) {
    $_SESSION["decline_newdriver"] = "Esta CNH já possui cadastro no sistema!";
    $router->redirect("console/motoristas");
    die();
}
$nome = SanitizeSpecialChars($data["nome"]);
$sobrenome = SanitizeSpecialChars($data["sobrenome"]);
$titular = SanitizeSpecialChars($data["titular"]);
$email = SanitizeEmail($data["email"], "console/motoristas");
$phone = phoneValidate($data["phone1"], "console/motoristas");
$agencia = (new Banco())->find("banco = :ban", "ban={$data["agencia"]}")->fetch(true);


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
$motorista = new Motorista();
$motorista->status_conta = "1";
$motorista->nome = $nome;
$motorista->sobrenome = $sobrenome;
$motorista->cpf = $data["cpf"];
$motorista->rg = $data["rg"];
$motorista->cnh = $data["cnh"];
$motorista->validade_cnh = $data["validadecnh"];
$motorista->email = $email;
$motorista->telefone1 = $phone;
$motorista->senha = password_hash($pass, PASSWORD_DEFAULT);
if (isset($data["indivisivel"])) {
    $motorista->indivisivel = $data["indivisivel"];
}
if (isset($data["mopp"])) {
    $motorista->mopp = $data["mopp"];
}
$motorista->cep = $data["cep"];
$motorista->rua = $data["rua"];
$motorista->numero = $data["numero"];
$motorista->bairro = $data["bairro"];
$motorista->cidade = $data["cidade"];
$motorista->estado = $data["estado"];

$motorista->banco = $data["agencia"];
$motorista->ag = $agencia[0]->cod;
$motorista->conta = $data["conta"];
$motorista->cpf_conta = $data["cpf_conta"];
$motorista->titular = $titular;

$motorista->save();
//echo "<pre>", var_dump($data), "</pre>";
if ($motorista->save() != false) {

    //Create a new PHPMailer instance
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d/m/Y');

    $mail = getSend();
    $titlemail = utf8_decode("Bem vindo à Transdoni Fretes | {$motorista->nome} {$motorista->sobrenome}");
    $mail->AddAddress("{$motorista->email}", "{$titlemail}");
    $mail->SetFrom("atendimento@softgbs.com", "Gustavo Bomfim");
    $mail->Subject = $titlemail;
    $content = str_replace(array('%date%', '%username%', '%login%', '%password%', '%botaoapp%'), array($date, $motorista->nome . " " . $motorista->sobrenome, $motorista->email, $pass, url("app/login")), file_get_contents('theme/dashboard/mailer/welcomedriver.html'));
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/image.jpeg", "background");
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/logotd_Lzg.png", "my-logo");
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/74371525781549159.png", "google-play");
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/81101525781549293.png", "app-store");
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/facebook-rounded-white-bordered.png", "facebook");
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/instagram-rounded-white-bordered.png", "instagram");
    $mail->AddEmbeddedImage("theme/dashboard/mailer/images/pinterest-rounded-white-bordered.png", "pinterest");
    $mail->msgHTML(utf8_decode($content), __DIR__);

    //send the message, check for errors
    if (!$mail->send()) {
        $_SESSION["decline_newdriver"] = 'Mailer Error: ' . $mail->ErrorInfo;
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        $router->redirect("/console/motoristas");
    } else {
        $_SESSION["success_newdriver"] = "Motorista {$motorista->nome} criado com sucesso!";
        echo "Motorista {$motorista->nome} criado com sucesso!";
        $router->redirect("/console/motoristas");

        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}

//echo "<pre>", var_dump($motorista), "</pre>";

//return $router->redirect("/console");