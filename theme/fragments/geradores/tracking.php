<?php
/**
 * @var $data
 */
use CoffeeCode\Router\Router;
use Source\Models\Frete;


$router = new Router(URL_BASE);

$tracking = (new Frete())->find("doc_viagem_cte = :doc", "doc={$data["tracking"]}")->fetch(true);
if(!isset($_SESSION)){
session_start();
}

if ($tracking) {
    if ($tracking[0]->status_frete == 1) {
        unset($_SESSION["statusfail"]);
        $_SESSION["statusfail"] = "Número de CTE Encontrado! Aguarde até que as informações fiquem disponíveis";
        $router->redirect("/");
    } else {
        unset($_SESSION["statusfail"]);
        $router->redirect("/rastrear/{$data["tracking"]}");
    }
} else {
    unset($_SESSION["statusfail"]);
    $_SESSION["statusfail"] = "Número de CTE inválido!";
    $router->redirect("/");

}
