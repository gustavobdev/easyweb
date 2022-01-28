<?php

use CoffeeCode\Router\Router;
use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Reboque;

if (!isset($_SESSION)) {
    session_start();
}

$router = new Router(URL_BASE);

$motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");
$reboque_select = (new Reboque())->findById("{$data["reb_id"]}");

if (isset($motorista)) {

    $motorista->id_reboque = $data["reb_id"];
    $motorista->save();

    if ($motorista->save() === true) {

        $_SESSION["save_car"] = "Você selecionou o reboque {$reboque_select->modelo} - Placa: {$reboque_select->placa_reboque} para receber fretes";
        $router->redirect("app/editreboque");
    } else {
        $_SESSION["decline_car"] = "Algo de errado aconteceu! tente novamente.";
        $router->redirect("app/editreboque");
    }
} else {
    $_SESSION["decline_car"] = "Algo de errado aconteceu! tente novamente.";
    $router->redirect("app/editreboque");
}
