<?php

use CoffeeCode\Router\Router;


function emServico()
{
    $router = new Router(URL_BASE);

    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["em_servico"])) {

        $_SESSION["decline_perfil"] = "Fique em Disponível para acessar seus fretes";
        $router->redirect("app/perfil");
    }
}
