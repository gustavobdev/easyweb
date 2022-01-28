<?php

use CoffeeCode\Router\Router;
use Source\Models\Caminhao;
use Source\Models\Motorista;

if (!isset($_SESSION)) {
    session_start();
}

$router = new Router(URL_BASE);

$motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");
$caminhao_select = (new Caminhao())->findById("{$data["car_id"]}");

if (isset($motorista)) {

    $motorista->id_caminhao = $caminhao_select->id;
    $motorista->save();

    if ($motorista->save() === true) {

        $_SESSION["save_car"] = "Você selecionou o carro {$caminhao_select->modelo} - Placa: {$caminhao_select->placa_caminhao} para receber fretes";
        $router->redirect("app/editcar");
    } else {
        $_SESSION["decline_car"] = "Algo de errado aconteceu! tente novamente.";
        $router->redirect("app/editcar");
    }
} else {
    $_SESSION["decline_car"] = "Algo de errado aconteceu! tente novamente.";
    $router->redirect("app/editcar");
}
