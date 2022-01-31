<?php

use CoffeeCode\Router\Router;
use Source\Models\Caminhao;
use Source\Models\Frete;
use Source\Models\Log_Fretes;
use Source\Models\Motorista;
use Source\Models\Reboque;
use Source\Models\Relacao_Caminhao;
use Source\Models\Relacao_Reboque;

$router = new Router(URL_BASE);

if (!isset($_SESSION)) {
    session_start();
}

/** Salva o id do motorista no frete */
$frete = (new Frete())->findById($data["id_frete_motorista"]);

$motorista = (new Motorista())->findById("{$data['motorista']}");
$motorista_banco = (new Motorista())->find("id = :mid", "mid={$frete->motorista}")->fetch(true);

$caminhao_post = (new Caminhao())->findById("{$data["caminhao"]}");
$caminhao_banco = (new Caminhao())->find("id = :cid", "cid={$motorista_banco[0]->id_caminhao}")->fetch(true);

if(isset($data["reboque"])):
$reboque_post = (new Reboque())->find("id = :rid","rid={$data["reboque"]}")->fetch(true);
endif;
$reboque_banco = (new Reboque())->find("id = :cid", "cid={$motorista_banco[0]->id_reboque}")->fetch(true);

$dados_post = array(
    "Motorista" => $motorista->nome . " " . $motorista->sobrenome,
    "Caminhao" => "Renavam: " . $caminhao_post->renavam_caminhao . " Modelo: " . $caminhao_post->modelo,
    $reboque_post ? "\"Reboque\" => \"Placa: \"" . $reboque_post[0]->placa_reboque . "\" Tipo: \"" . $reboque_post[0]->tipo_reboque : 'Vazio'

);

$dados_tabela = array(
    "Motorista" => $motorista_banco ? $motorista_banco[0]->nome . " " . $motorista_banco[0]->sobrenome : "Vazio",
    "Caminhao" => $caminhao_banco ? "Renavam: " . $caminhao_banco[0]->renavam_caminhao . " Modelo: " . $caminhao_banco[0]->modelo : "Vazio",
    "Reboque" =>   $reboque_banco ? "Placa: " . $reboque_banco[0]->placa_reboque . " Tipo: " . $reboque_banco[0]->tipo_reboque : "Vazio"

);

$frete->motorista = $data['motorista'];
$frete->save();

/** Salva o id do reboque e do caminhão no motorista */


if ($motorista) {
    $relacao_caminhao = (new Relacao_Caminhao())->findById("{$data["caminhao"]}");

    $motorista->id_caminhao = $relacao_caminhao->id_caminhao;

    if($data["reboque"]):
        $relacao_reboque = (new Relacao_Reboque())->findById("{$data["reboque"]}");

    $motorista->id_reboque = $relacao_reboque->id_reboque;
    endif;
    $motorista->save();
}



//echo "<pre>", var_dump($motorista), "</pre>";
if ($motorista->save() && $frete->save()) {
    $_SESSION["success_frete"] = "Motorista, caminhão e reboque atualizados com sucesso!";


    $arr_dif = array_diff_assoc($dados_post, $dados_tabela);
    foreach ($arr_dif as $key => $value) {
        if (is_null($dados_post["$key"]) xor empty($dados_post["$key"])) {
            $dados_post["$key"] = "VAZIO";
        }
        $logfrete = new Log_Fretes();
        $logfrete->frete_id = $frete->id;
        $logfrete->user_id = $_SESSION["user_id"];
        $logfrete->campo = $key;
        $logfrete->val_antigo = $dados_tabela["$key"];
        $logfrete->val_novo = $dados_post["$key"];
        $logfrete->save();
    }
} else {
    $_SESSION["decline_frete"] = "Erro na solicitação!";
}

$router->redirect("console/fretes/{$data["id_frete_motorista"]}");
