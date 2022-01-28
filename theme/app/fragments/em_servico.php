<?php

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);


    session_start();
var_dump($data["emservico"]);
if ($data['emservico'] === "habilitar") {

    $_SESSION["em_servico"] = true;
    $_SESSION["save_perfil"] = "Você está ATIVO e já pode receber fretes!";
    echo "habilitado";
    $router->redirect("app/perfil");

    } 
    if($data["emservico"] === "desabilitar") {
    unset($_SESSION["em_servico"]);
    $_SESSION["save_perfil"] = "Você ficou INATIVO, para reeber frentes habilite novamente!";
    echo "desabilitado";
    $router->redirect("app/perfil");
    }

?>