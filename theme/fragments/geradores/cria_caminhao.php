<?php

use CoffeeCode\Router\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Source\Models\Banco;
use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Reboque;
use Source\Models\Relacao_Caminhao;
use Source\Models\Relacao_Reboque;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}


var_dump($data);
$motorista = (new Motorista())->find("id = :idm", "idm={$data["motorista"]}")->fetch(true);
if (!isset($motorista)) {
    $_SESSION["decline_newdriver"] = "Adicione um motorista!";
    $router->redirect("console/cria/caminhao");

    die();
}




$cor = SanitizeSpecialChars($data["cor"]);
if (
    is_null($data["renavam_caminhao"]) xor empty($data["renavam_caminhao"]) ||
    is_null($data["placa_caminhao"]) xor empty($data["placa_caminhao"]) ||
    is_null($data["modelo_caminhao"]) xor empty($data["modelo_caminhao"]) ||
    is_null($data["cor"]) xor empty($data["cor"]) ||
    is_null($data["tipo_caminhao"]) xor empty($data["tipo_caminhao"])
) {
    echo "ta vazio";
    $salvacaminhao = false;

}else{
    $renavam_caminhao = (new Caminhao())->find("renavam_caminhao = :ema and placa_caminhao = :pla", "ema={$data["renavam_caminhao"]}&pla={$data["placa_caminhao"]}")->fetch(true);
    if (isset($renavam_caminhao)) {
        $_SESSION["decline_newdriver"] = "O caminhão já possui cadastro no sistema!";
        $router->redirect("console/cria/caminhao");
        die();
    }
    /**Salva Caminhão */
    $caminhao = new Caminhao();
    if (isset($data["caminhao_interno"])) {
        $caminhao->interno = "1";
    } else {
        $caminhao->interno = null;
    }
    $caminhao->renavam_caminhao = $data["renavam_caminhao"];
    $caminhao->validade_renavam = $data["validade_renavamcam"];
    $caminhao->placa_caminhao = $data["placa_caminhao"];
    $caminhao->modelo = $data["modelo_caminhao"];
    $caminhao->cor = $data["cor"];
    $caminhao->tipo_caminhao = $data["tipo_caminhao"];
    $caminhao->obs = $data["obs_caminhao"];
    $caminhao->save();
    $relacao_caminhao = new Relacao_Caminhao();
    $relacao_caminhao->id_motorista = $data["motorista"];
    $relacao_caminhao->id_caminhao = $caminhao->id;
    $relacao_caminhao->save();
    if ($caminhao->save() != false) {
        $salvacaminhao = true;
    }
} 
   


if (
    is_null($data["renavam_reboque"]) xor empty($data["renavam_reboque"]) ||
    is_null($data["placa_reboque"]) xor empty($data["placa_reboque"]) ||
    is_null($data["tipo_reboque"]) xor empty($data["tipo_reboque"])
)  {
    echo "ta vazio";
    $salvareboque = false;

}else{
    $renavam_reboque = (new Reboque())->find("renavam_reboque = :ema and placa_reboque = :pla", "ema={$data["renavam_reboque"]}&pla={$data["placa_reboque"]}")->fetch(true);
    if (isset($renavam_reboque)) {
        $_SESSION["decline_newdriver"] = "O reboque já possui cadastro no sistema!";
        $router->redirect("console/cria/caminhao");
        die();
    }
    /**Salva Reboque */
    $reboque = new Reboque();
    if (isset($data["reboque_interno"])) {
        $reboque->interno = "1";
    } else {
        $reboque->interno = null;
    }
    $reboque->renavam_reboque = $data["renavam_reboque"];
    $reboque->validade_renavam = $data["validade_renavamreb"];
    $reboque->placa_reboque = $data["placa_reboque"];
    $reboque->tipo_reboque = $data["tipo_reboque"];
    $reboque->save();
    $relacao_reboque = new Relacao_Reboque();
    $relacao_reboque->id_motorista = $data["motorista"];
    $relacao_reboque->id_reboque = $reboque->id;
    $relacao_reboque->save();

    if ($reboque->save() != false) {
        $salvareboque = true;
    }
}

if ($salvacaminhao === true && $salvareboque === false) {
    $_SESSION["success_newdriver"] = "Caminhão registrado com sucesso no nome de {$motorista[0]->nome}!";
    $router->redirect("/console/cria/caminhao");
    die();
} elseif ($salvareboque === true && $salvacaminhao === false) {
    $_SESSION["success_newdriver"] = "Reboque registrado com sucesso no nome de {$motorista[0]->nome}!";
    $router->redirect("/console/cria/caminhao");
    die();
} elseif ($salvacaminhao === true && $salvareboque === true) {
    $_SESSION["success_newdriver"] = "Caminhão e Reboque registrado com sucesso no nome de {$motorista[0]->nome}!";
    $router->redirect("/console/cria/caminhao");
    die();
} else {
    $_SESSION["decline_newdriver"] = "Houve um erro na solicitação!";
    $router->redirect("/console/cria/caminhao");
    die();
}
/*
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
$mail->motoristaname = 'mdmion@gmail.com';
$mail->Password = 'marcelo247867';
$titlemail = utf8_decode("Bem vindo à GBS Rush | $motorista->first_name");
$mail->AddAddress($motorista->email , "$titlemail");
$mail->SetFrom("atendimento@softgbs.com", "Gustavo Bomfim");
$mail->Subject = $titlemail;
$content = str_replace(array('%name%', '%lastname%', '%email%', '%password%','%date%'), array($motorista->first_name, $motorista->last_name, $motorista->email, $motorista->password, $date), file_get_contents('theme/dashboard/mailer/mail.html'));
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

echo "<pre>", var_dump($motorista), "</pre>";

return $router->redirect("/console");
*/