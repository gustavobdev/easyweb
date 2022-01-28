<?php

use CoffeeCode\Router\Router;
use Source\Models\Cliente;
use Source\Models\Frete;
use Source\Models\Log_Fretes;

if(!isset($_SESSION)){
    session_start();
}
$router = new Router(URL_BASE);

$frete = (new Frete())->findById($data["id_frete_cliente"]);

$cliente_post = (new Cliente())->findById("{$data['cliente']}");
$cliente_banco = (new Cliente())->find("id = :cid","cid={$frete->cliente_transportadora}")->fetch(true);

$dados_post = array(
    "Altera Cliente" => $cliente_post->razao_social
);
$dados_tabela = array(   
    "Altera Cliente"  => $cliente_banco ? $cliente_banco->razao_social : "vazio"
);

$arr_dif = array_diff_assoc($dados_post, $dados_tabela);
foreach ($arr_dif as $key => $value) {
  if(is_null($dados_post["$key"]) xor empty($dados_post["$key"])){
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
$frete->cliente_transportadora = $data['cliente'];
$frete->save();

$_SESSION["success_frete"] = "Cliente cadastrado no frete com sucesso!";
$router->redirect("console/fretes/{$data["id_frete_cliente"]}");