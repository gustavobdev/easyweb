<?php

use CoffeeCode\Router\Router;

function PreenchePerfil()
{
    $router = new Router(URL_BASE);

    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION["driver_id"])){
        foreach ($_SESSION as $value) {
            if (empty($value) xor is_null($value)) {
                session_start();
                $_SESSION["decline_perfil"] = "Olá {$_SESSION["driver_first_name"]}, complete as informações do seu perfil para fazer viagens";
                $router->redirect("app/perfil");
                die();
           }
        }       
    }   
}