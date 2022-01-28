<?php

use CoffeeCode\Router\Router;
use Source\Models\Motorista;

$router = new  Router(URL_BASE);

if (!isset($_SESSION)) {
    session_start();
}

$address = (new Motorista())->findById("{$data["driver_id"]}");

if ($data) {
    foreach ($data as $key => $value) {
        if (empty($value) or is_null($value)) {
            $_SESSION["decline_perfil"] = "Dados incompletos! por favor adicione todas as informações";
            $router->redirect("app/perfil");
            die();
        }
    }

    $address->rua = $data["rua"];
    $address->cep = $data["cep"];
    $address->numero = $data["numero"];
    $address->bairro = $data["bairro"];
    $address->cidade = $data["cidade"];
    $address->estado = $data["estado"];
    $address->save();
}

if ($address->save()) {
    $_SESSION["driver_rua"] = $address->rua;
    $_SESSION["driver_cep"] = $address->cep;
    $_SESSION["driver_numero"] = $address->numero;
    $_SESSION["driver_bairro"] = $address->bairro;
    $_SESSION["driver_cidade"] = $address->cidade;
    $_SESSION["driver_estado"] = $address->estado;
    $_SESSION["save_perfil"] = "Endereço atualizado com sucesso!";

    $router->redirect("app/perfil");
}
