<?php

use CoffeeCode\Router\Router;
use Source\Models\Frete;
use Source\Models\Status_frete;

$router = new Router(URL_BASE);

$frete = (new Frete())->findById($data["id_status"]);
$status_frete = (new Status_frete)->find("id = :mde", "mde={$data['status']}")->fetch(true);
if($status_frete[0]->id === "2" && $data["tem_motorista"]){
    session_start();
    $_SESSION["decline_frete"] = "Já existe um motorista para este frete!";
    $router->redirect("console/fretes/{$data["id_status"]}");

}elseif (!$data["tem_motorista"] && $status_frete[0]->id === "4"){
    session_start();
    $_SESSION["decline_frete"] = "Você precisa adicionar ou aprovar motorista para este frete!";
    $router->redirect("console/fretes/{$data["id_status"]}");

} elseif (!$data["tem_motorista"] && $status_frete[0]->id === "5") {
    session_start();
    $_SESSION["decline_frete"] = "Você precisa adicionar ou aprovar motorista para este frete!";
    $router->redirect("console/fretes/{$data["id_status"]}");


} elseif (!$data["tem_motorista"] && $status_frete[0]->id === "6") {
    session_start();
    $_SESSION["decline_frete"] = "Você precisa adicionar ou aprovar motorista para este frete!";
    $router->redirect("console/fretes/{$data["id_status"]}");

} elseif (!$data["tem_cliente"] && $status_frete[0]->id === "4") {
    session_start();
    $_SESSION["decline_frete"] = "Você precisa adicionar um cliente para este frete!";
    $router->redirect("console/fretes/{$data["id_status"]}");
} elseif (!$data["tem_cliente"] && $status_frete[0]->id === "5") {
    session_start();
    $_SESSION["decline_frete"] = "Você precisa adicionar um cliente para este frete!";
    $router->redirect("console/fretes/{$data["id_status"]}");

}else{
    $frete->status_frete = $data['status'];
    $frete->save();
    session_start();
    $_SESSION["success_frete"] = "Status alterado para {$status_frete[0]->status_desc}";
    
$router->redirect("console/fretes/{$data["id_status"]}");

}