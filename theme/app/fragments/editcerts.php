<?php

use Source\Models\Motorista;
use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

foreach ($data as $key => $value) {
    if (empty($value) and is_null($value)) {
        $data["$key"] = null;
    }
}
if(!isset($_SESSION)){
session_start();
}


$driver = (new Motorista())->findById("{$_SESSION["driver_id"]}");
$driver->mopp = $data["mopp"];
$driver->indivisivel = $data["indivisivel"];
$driver->save();

$_SESSION["driver_mopp"] = $driver->mopp;
$_SESSION["driver_indivisivel"] = $driver->indivisivel;
$_SESSION["save_perfil"] = "Certificados atualizados com sucesso!";
$router->redirect("app/perfil");
