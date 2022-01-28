<?php

use CoffeeCode\Router\Router;
use Source\Models\Cliente;
use Source\Models\Frete;
use Source\Models\Log_Fretes;

$router = new Router(URL_BASE);

$frete = (new Frete())->findById($data["id_frete_operacao"]);

if (!isset($_SESSION)) {
    session_start();
}


/**Conversao CHEGADA TERMMINAL */
if (!empty($data['cda_terminal_coleta']) && !is_null($data['cda_terminal_coleta'])) {
    $cda = $data['cda_terminal_coleta'];
    $cda = explode(" ", $cda);
    list($date, $hora) = $cda;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $cda_terminal_coleta = $data_sem_barra . " " . $hora;
} else {
    $cda_terminal_coleta = null;
}
/********************/


/** Conversao SAIDA TERMINAL */
if (!empty($data['sda_terminal_coleta']) && !is_null($data['sda_terminal_coleta'])) {
    $sda = $data['sda_terminal_coleta'];
    $sda = explode(" ", $sda);
    list($date, $hora) = $sda;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $sda_terminal_coleta = $data_sem_barra . " " . $hora;
} else {
    $sda_terminal_coleta = null;
}
/*******************/


/** Conversao PREV CHEGADA CLIENTE */
if (!empty($data['prev_cda_cliente']) && !is_null($data['prev_cda_cliente'])) {
    $prev_cda = $data['prev_cda_cliente'];
    $prev_cda = explode(" ", $prev_cda);
    list($date, $hora) = $prev_cda;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $prev_chegada_cliente = $data_sem_barra . " " . $hora;
} else {
    $prev_chegada_cliente = null;
}
/*******************/


/** Conversao CHEGADA CLIENTE */
if (!empty($data['cda_cliente']) && !is_null($data['cda_cliente'])) {
    $cda_cliente = $data['cda_cliente'];
    $cda_cliente = explode(" ", $cda_cliente);
    list($date, $hora) = $cda_cliente;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $cda_cliente = $data_sem_barra . " " . $hora;
} else {
    $cda_cliente = null;
}
/*******************/


/** Conversao SAIDA CLIENTE */
if (!empty($data['sda_cliente']) && !is_null($data['sda_cliente'])) {
    $sda_cliente = $data['sda_cliente'];
    $sda_cliente = explode(" ", $sda_cliente);
    list($date, $hora) = $sda_cliente;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $sda_cliente = $data_sem_barra . " " . $hora;
} else {
    $sda_cliente = null;
}
/*******************/


/** Conversao PREV CHEGADA DEVOLUCAO */
if (!empty($data['prev_cda_devolucao']) && !is_null($data['prev_cda_devolucao'])) {
    $prev_chegada_devolucao = $data['prev_cda_devolucao'];
    $prev_chegada_devolucao = explode(" ", $prev_chegada_devolucao);
    list($date, $hora) = $prev_chegada_devolucao;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $prev_chegada_devolucao = $data_sem_barra . " " . $hora;
} else {
    $prev_chegada_devolucao = null;
}
/*******************/


/** Conversao PREV CHEGADA DEVOLUCAO */
if (!empty($data['devolucao_vazio']) && !is_null($data['devolucao_vazio'])) {
    $devolucao_vazio = $data['devolucao_vazio'];
    $devolucao_vazio = explode(" ", $devolucao_vazio);
    list($date, $hora) = $devolucao_vazio;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $devolucao_vazio = $data_sem_barra . " " . $hora;
} else {
    $devolucao_vazio = null;
}

/*******************/
$dados_tabela = array(
    "Chegada terminal coleta" => $frete->cda_terminal_coleta,
    "Saída terminal coleta" => $frete->sda_terminal_coleta,
    "Prev chegada cliente" =>  $frete->prev_chegada_cliente,
    "Chegada cliente" =>   $frete->cda_cliente,
    "Saida cliente" =>  $frete->sda_cliente,
    "Prev chegada devolucao" => $frete->prev_chegada_devolucao,
    "Devolucao vazio" =>  $frete->devolucao_vazio
);

$dados_post = array(
    "Chegada terminal coleta" => $cda_terminal_coleta ? $cda_terminal_coleta : "Vazio",
    "Saída terminal coleta" => $sda_terminal_coleta ? $sda_terminal_coleta : "Vazio",
    "Prev chegada cliente" => $prev_chegada_cliente ? $prev_chegada_cliente : "Vazio",
    "Chegada cliente" => $cda_cliente ? $cda_cliente : "Vazio",
    "Saida cliente" => $sda_cliente ? $sda_cliente : "Vazio",
    "Prev chegada devolucao" => $prev_chegada_devolucao ? $prev_chegada_devolucao : "Vazio",
    "Devolucao vazio" =>  $devolucao_vazio ? $devolucao_vazio : "Vazio"
);

if ($frete) {

    $frete->cda_terminal_coleta = $cda_terminal_coleta;
    $frete->sda_terminal_coleta = $sda_terminal_coleta;
    $frete->prev_chegada_cliente = $prev_chegada_cliente;
    $frete->cda_cliente = $cda_cliente;
    $frete->sda_cliente = $sda_cliente;
    $frete->prev_chegada_devolucao = $prev_chegada_devolucao;
    $frete->devolucao_vazio = $devolucao_vazio;
    $frete->save();
}

if ($frete->save() != false) {
    $arr_dif = array_diff_assoc($dados_post, $dados_tabela);
    foreach ($arr_dif as $key => $value) {
        if (is_null($dados_post["$key"]) or empty($dados_post["$key"])) {
            $dados_post["$key"] = "Vazio";
        }
        $logfrete = new Log_Fretes();
        $logfrete->frete_id = $frete->id;
        $logfrete->user_id = $_SESSION["user_id"];
        $logfrete->campo = $key;
        $logfrete->val_antigo = $dados_tabela["$key"];
        $logfrete->val_novo = $dados_post["$key"];
        $logfrete->save();
    }
    if ($frete->status_frete === "6") {

        $cliente = (new Cliente())->findById("{$frete->cliente_transportadora}");
        $mail = getSend();
        $titlemail = utf8_decode("Atualização de tracking | {$cliente->razao_social}");
        $mail->AddAddress("{$cliente->email}", "{$titlemail}");
        $mail->SetFrom("atendimento@softgbs.com", "Transdoni Fretes");
        $mail->Subject = $titlemail;
        $content = str_replace(array('%cliente%','%date%','%link%', '%docviagemcte%'), array($cliente->razao_social,date("d/m/Y"), url("rastrear/{$frete->doc_viagem_cte}"), $frete->doc_viagem_cte), file_get_contents('theme/dashboard/mailer/clienteattrack.html'));
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/logotd_Lzg.png", "my-logo");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/track_BAj.png", "img-track");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/vector_Pm3.png", "img-nuvem");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group2.png", "png-one");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group1.png", "png-two");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group_fHk.png", "png-three");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/facebook-circle-colored.png", "facebook");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/instagram-circle-colored.png", "instagram");
        $mail->msgHTML(utf8_decode($content), __DIR__);
        $mail->send();
    }
    $_SESSION["success_frete"] = "Alterações nas datas operacionais feitas com sucesso!";
} else {
    $_SESSION["decline_frete"] = "Erro na solicitação!";
}



$router->redirect("console/fretes/{$data["id_frete_operacao"]}");
