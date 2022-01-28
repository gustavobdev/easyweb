<?php

use CoffeeCode\Router\Router;
use Source\Models\Banco;
use Source\Models\Motorista;

$router = new Router(URL_BASE);
if(!isset($_SESSION)){
    session_start();
}

$bank = (new Motorista())->findById("{$data["driver_id"]}");
$pegacodagencia = (new Banco())->find("banco = :ban", "ban={$data["banco"]}")->fetch(true);

if ($data) {
    foreach ($data as $key => $value) {
        if (empty($value) or is_null($value)) {
            $_SESSION["decline_bank"] = "Dados incompletos! por favor adicione todas as informações";
            $router->redirect("app/perfil");
            die();
        }
    }
    $bank->banco = $data["banco"];
    $bank->ag = $pegacodagencia[0]->cod;
    $bank->conta = $data["conta"];
    $bank->cpf_conta = $data["cpf_conta"];
    $bank->titular = $data["titular"];
    $bank->save();
}
if($bank->save() != false)
  {
    $_SESSION["save_bank"] = "Informações Bancárias atualizadas com sucesso!";
    $_SESSION["driver_banco"] = $bank->banco;
    $_SESSION["driver_ag"] = $bank->ag;
    $_SESSION["driver_conta"] = $bank->conta;
    $_SESSION["driver_cpf_conta"] = $bank->cpf_conta;
    $_SESSION["driver_titular"] = $bank->titular;
    $router->redirect("app/perfil");
  }else{
    $_SESSION["decline_bank"] = "Ocorreu um erro ao atualizar as informações Bancárias!";
    $router->redirect("app/perfil");

  }
