<?php

use CoffeeCode\Router\Router;
use Source\Models\Banco;
use Source\Models\Motorista;

if (!isset($_SESSION)) {
  session_start();
}
$router = new Router(URL_BASE);
$driver = (new Motorista())->findById("{$data["driver_id"]}");
$demail = (new Motorista())->find("id != :mid and email = :ema", "mid={$driver->id}&ema={$data["driver_email"]}")->fetch(true);
$dcpf = (new Motorista())->find("id != :mid and cpf = :cpf", "mid={$driver->id}&cpf={$data["driver_cpf"]}")->fetch(true);
$drg = (new Motorista())->find("id != :mid and rg = :rgg ", "mid={$driver->id}&rgg={$data["driver_rg"]}")->fetch(true);
$dcnh = (new Motorista())->find("id != :mid and cnh = :cnh", "mid={$driver->id}&cnh={$data["driver_cnh"]}")->fetch(true);

if ($demail) {
  $_SESSION["decline_newuser"] = "Dado cadastral (EMAIL) pertence a outro usuário do sistema!";
  $router->redirect("console/motoristas");
  die();
} elseif ($dcpf) {
  $_SESSION["decline_newuser"] = "Dado cadastral (CPF) já pertence a outro usuário do sistema!";
  $router->redirect("console/motoristas");
  die();
} elseif (isset($drg)) {
  $_SESSION["decline_newuser"] = "Dado cadastral (RG) já pertence a outro usuário do sistema!";
  $router->redirect("console/motoristas");
  die();
} elseif (isset($dcnh)) {
  $_SESSION["decline_newuser"] = "Dado cadastral (CNH) já pertence a outro usuário do sistema!";
  $router->redirect("console/motoristas");
  die();
}

foreach ($data as $key => $value) {
  if (empty($value) xor is_null($value)) {
    echo "campo $key";
    $_SESSION["decline_newuser"] = "Preencha todos os Campos para atualizar o perfil do(a) {$driver->nome}!";
    $router->redirect("console/motoristas");
    die();
  }
}

if (isset($driver)) {
  $nome = SanitizeSpecialChars($data["driver_nome"]);
  $sobrenome = SanitizeSpecialChars($data["driver_sobrenome"]);
  $titular = SanitizeSpecialChars($data["driver_titular"]);
  $email = SanitizeEmail($data["driver_email"], "console/motoristas");
  $phone = phoneValidate($data["driver_phone"], "console/motoristas");

  $agencia = (new Banco())->find("banco = :ban", "ban={$data["driver_agencia"]}")->fetch(true);
  if(!empty($data["driver_status"]) xor !is_null($data["driver_status"])){
  $driver->status_conta = $data["driver_status"];
  }
  $driver->nome = $nome;
  $driver->sobrenome = $sobrenome;
  $driver->email = $email;
  $driver->cpf = $data["driver_cpf"];
  $driver->rg = $data["driver_rg"];
  $driver->cnh = $data["driver_cnh"];
  $driver->validade_cnh = $data["driver_validadecnh"];
  $driver->telefone1 = $phone;
  $driver->cep = $data["driver_cep"];
  $driver->rua = $data["driver_rua"];
  $driver->numero = $data["driver_numero"];
  $driver->bairro = $data["driver_bairro"];
  $driver->cidade = $data["driver_cidade"];
  $driver->banco = $data["driver_agencia"];
  $driver->ag =   $agencia[0]->cod;
  $driver->conta = $data["driver_conta"];
  $driver->cpf_conta = $data["driver_cpftitular"];
  $driver->titular = $titular;

  if (isset($data["driver_mopp"])) {
    $driver->mopp = "1";
  } else {
    $driver->mopp = null;
  }
  if (isset($data["driver_indivisivel"])) {
    $driver->indivisivel = "1";
  } else {
    $driver->indivisivel = null;
  }

  $driver->save();
}
if ($driver->save() != false) {

  $_SESSION["success_newuser"] = "Motorista {$driver->nome} atualizado com sucesso!";
  $router->redirect("console/motoristas");
  //echo "<pre>", var_dump($data), "</pre> <hr> <pre>", var_dump($user), "</pre>";
} else {
  $_SESSION["decline_newuser"] = "Ocorreu um erro durante a atualização do perfil";
  $router->redirect("console/motoristas");
}
