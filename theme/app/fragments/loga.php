<?php

use CoffeeCode\Router\Router;
use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Reboque;
use Source\Models\Relacao_Caminhao;

$driver = (new Motorista())->find("email = :iem AND senha = :ips", "iem={$data["email"]}&ips={$data["senha"]}")->fetch(true);
$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

if ($driver) {

    session_start();
    /**INFORMAÇÕES PESSOAIS */
    $_SESSION["profile_photo"] = $driver["0"]->profile_photo;
    $_SESSION["driver_first_name"] = $driver["0"]->nome;
    $_SESSION["driver_last_name"] = $driver["0"]->sobrenome;
    $_SESSION["driver_email"] = $driver["0"]->email;
    $_SESSION["driver_cpf"] = $driver["0"]->cpf;
    $_SESSION["driver_fone1"] = $driver["0"]->telefone1;
    $_SESSION["driver_fone2"] = $driver["0"]->telefone2;

    /**INFORMAÇÕES DO CAMINHÃO E REBOQUE SELECIONADO */
    $_SESSION["driver_caminhao"] = $driver["0"]->id_caminhao;
    $_SESSION["driver_reboque"] = $driver["0"]->id_reboque;
    if (empty($_SESSION['driver_caminhao']) or is_null($_SESSION['driver_caminhao']) or $_SESSION['driver_caminhao'] === "") {
        unset($_SESSION['driver_caminhao']);
    }
    if (empty($_SESSION['driver_reboque']) or is_null($_SESSION['driver_reboque']) or $_SESSION['driver_reboque'] === "") {
        unset($_SESSION['driver_reboque']);
    }
    /**INFRMAÇÕES BANCÁRIAS */
    $_SESSION["driver_banco"] = $driver["0"]->banco;
    $_SESSION["driver_ag"] = $driver["0"]->ag;
    $_SESSION["driver_conta"] = $driver["0"]->conta;
    $_SESSION["driver_titular"] = $driver["0"]->titular;
    $_SESSION["driver_cpf_conta"] = $driver["0"]->cpf_conta;

    /**ENDEREÇO */
    $_SESSION["driver_rua"] = $driver["0"]->rua;
    $_SESSION["driver_numero"] = $driver["0"]->numero;
    $_SESSION["driver_bairro"] = $driver["0"]->bairro;
    $_SESSION["driver_cidade"] = $driver["0"]->cidade;
    $_SESSION["driver_estado"] = $driver["0"]->estado;
    $_SESSION["driver_cep"] = $driver["0"]->cep;
    $_SESSION["driver_id"] = $driver["0"]->id;

    /**CERTIFICADOS */
    $_SESSION['driver_mopp'] = $driver["0"]->mopp;
    $_SESSION['driver_indivisivel'] = $driver["0"]->indivisivel;

    if (empty($_SESSION['driver_mopp']) xor is_null($_SESSION['driver_mopp']) or $_SESSION['driver_mopp'] === "") {
        unset($_SESSION['driver_mopp']);
    }
    if (empty($_SESSION['driver_indivisivel']) xor is_null($_SESSION['driver_indivisivel']) or $_SESSION['driver_indivisivel'] === "") {
        unset($_SESSION['driver_indivisivel']);
    }
    if(empty($driver["0"]->last_login) xor is_null($driver["0"]->last_login)){

        $_SESSION["boas_vindas"] = "Bem vindo {$newdriver->nome}, complete algumas informações no seu perfil para fazer viagens!";
        $date = new DateTime();
        $driver["0"]->last_login = $date->format( "Y-m-d H:i:s" ) . ' ';
        $driver["0"]->save();
        $router->redirect("/app/perfil");
        die();
    }else{
    $date = new DateTime();
    $driver["0"]->last_login = $date->format( "Y-m-d H:i:s" ) . ' ';
    $driver["0"]->save();
    PreenchePerfil();
    $router->redirect("/app");
    }
} else {
    $_SESSION["appreg_decline"] = "Login ou senha incorretos!";
    $router->redirect("app/login");
}
