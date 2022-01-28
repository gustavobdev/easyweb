<?php

use CoffeeCode\Router\Router;
use Source\Models\Motorista;
$router = new Router(URL_BASE);
if(!isset($_SESSION)){
session_start();
}

foreach ($data as $value) {
    if (empty($value) xor is_null($value)) {

        $_SESSION["appreg_decline"] = "Dados incompletos! por favor adicione todas as informações";
        $router->redirect("app/register");
        die();
    }
}
if ($data["senha"] !== $data["confsenha"]) {

    $_SESSION["appreg_decline"] = "Suas senhas não coincidem!";
    $router->redirect("app/register");
}
$motorista = (new Motorista())->find("cpf = :cpf OR email = :ema", "cpf={$data["cpf"]}&ema={$data["email"]}")->fetch(true);


if (isset($motorista)) {
    $_SESSION["appreg_decline"] = "Você já possui cadastro em nosso sistema, efetue o login";
    $router->redirect("app/login");
} else {
    $newdriver = new Motorista();
    $newdriver->nome = $data["nome"];
    $newdriver->sobrenome = $data["sobrenome"];
    $newdriver->cpf = $data["cpf"];
    $newdriver->telefone1 = $data["phone"];
    $newdriver->email = $data["email"];
    $newdriver->senha = $data["senha"];
    $newdriver->save();

    
    /**INFORMAÇÕES PESSOAIS */
    $_SESSION["driver_first_name"] =  $newdriver->nome;
    $_SESSION["driver_last_name"] =  $newdriver->sobrenome;
    $_SESSION["driver_email"] =  $newdriver->email;
    $_SESSION["driver_cpf"] =  $newdriver->cpf;
    $_SESSION["driver_id"] = $newdriver->id;
    $_SESSION["driver_fone1"] = $newdriver->telefone1;
    $_SESSION["driver_fone2"] = $newdriver->telefone2;

    /**INFORMAÇÕES DO CAMINHÃO E REBOQUE SELECIONADO */
    $_SESSION["driver_caminhao"] = $newdriver->id_caminhao;
    $_SESSION["driver_reboque"] = $newdriver->id_reboque;

    /**INFRMAÇÕES BANCÁRIAS */
    $_SESSION["driver_banco"] = $newdriver->banco;
    $_SESSION["driver_ag"] = $newdriver->ag;
    $_SESSION["driver_conta"] = $newdriver->conta;
    $_SESSION["driver_titular"] = $newdriver->titular;
    $_SESSION["driver_cpf_conta"] = $newdriver->cpf_conta;

    /**ENDEREÇO */
    $_SESSION["driver_cep"] = $newdriver->cep;
    $_SESSION["driver_rua"] = $newdriver->rua;
    $_SESSION["driver_numero"] = $newdriver->numero;
    $_SESSION["driver_bairro"] = $newdriver->bairro;
    $_SESSION["driver_cidade"] = $newdriver->cidade;
    $_SESSION["driver_estado"] = $newdriver->estado;
    $_SESSION["boas_vindas"] = "Bem vindo {$newdriver->nome}, complete algumas informações no seu perfil para fazer fretes!";
    $router->redirect("app/perfil");
}
