<?php

use CoffeeCode\Router\Router;
use Source\Models\Cliente;

if (!isset($_SESSION)) {
  session_start();
}
$router = new Router(URL_BASE);
$client = (new Cliente())->findById("{$data["client_id"]}");

$cemail = (new Cliente())->find("id != :mid and email = :ema", "mid={$client->id}&ema={$data["cliente_email"]}")->fetch(true);
$ccnpj = (new Cliente())->find("id != :mid and cpf = :cnpj", "mid={$client->id}&cpf={$data["cliente_cnpj"]}")->fetch(true);
$cestad = (new Cliente())->find("id != :mid and rg = :rgg ", "mid={$client->id}&rgg={$data["cliente_inscricaoestadual"]}")->fetch(true);

if ($cemail) {
  $_SESSION["decline_newuser"] = "Dado cadastral (EMAIL) pertence a outro usuário do sistema!";
  $router->redirect("console/clientes");
  die();
} elseif ($ccnpj) {
  $_SESSION["decline_newuser"] = "Dado cadastral (CNPJ) já pertence a outro usuário do sistema!";
  $router->redirect("console/clientes");
  die();
} elseif (isset($cestad)) {
  $_SESSION["decline_newuser"] = "Dado cadastral (Inscrição Estadual) já pertence a outro usuário do sistema!";
  $router->redirect("console/clientes");
  die();
}

foreach ($data as $key => $value) {
  if (empty($value) xor is_null($value)) {
    echo "campo $key";
    $_SESSION["decline_newuser"] = "Preencha todos os Campos para atualizar o perfil do(a) {$client->razao_social}!";
    $router->redirect("console/clientes");
    die();
  }
}

if (isset($client)) {
  $razao_social = SanitizeSpecialChars($data["cliente_razaosocial"]);
  $nome_fantasia = SanitizeSpecialChars($data["cliente_nomefantasia"]);
  $email = SanitizeEmail($data["cliente_email"], "console/clientes");
  $telefone = phoneValidate($data["cliente_phone"], "console/clientes");
  $celular = phoneValidate($data["cliente_celular"], "console/clientes");

  $client->razao_social = $razao_social;
  $client->nome_fantasia = $nome_fantasia;
  $client->cnpj = $data["cliente_cnpj"];
  $client->inscricao_estadual = $data["cliente_inscricaoestadual"];
  $client->contato = $data["cliente_contato"];
  $client->email = $email;
  $client->telefone = $telefone;
  $client->celular = $celular;
  $client->website = $data["cliente_site"];
  $client->cep = $data["cliente_cep"];
  $client->rua = $data["cliente_rua"];
  $client->numero = $data["cliente_numero"];
  $client->bairro = $data["cliente_bairro"];
  $client->cidade = $data["cliente_cidade"];
  $client->estado = $data["cliente_estado"];
  $client->save();
}
if ($client->save() != false) {

  $_SESSION["success_newuser"] = "Cliente {$client->razao_social} atualizado com sucesso!";
  $router->redirect("console/clientes");
  //echo "<pre>", var_dump($data), "</pre> <hr> <pre>", var_dump($user), "</pre>";
} else {
  $_SESSION["decline_newuser"] = "Ocorreu um erro durante a atualização do perfil";
  $router->redirect("console/clientes");
}
