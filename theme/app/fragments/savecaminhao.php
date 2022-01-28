<?php
if (!isset($_SESSION)) {
    session_start();
}
use CoffeeCode\Router\Router;
use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Relacao_Caminhao;

$router = new Router(URL_BASE);


$router = new Router(URL_BASE);

    foreach ($data as $key => $value) {
        if (empty($value) or is_null($value)) {
            $_SESSION["decline_car"] = "Dados incompletos! por favor adicione todas as informações";
            $router->redirect("app/editcar");
            die();
        }
    }
    $renavam_caminhao = (new Caminhao())->find("renavam_caminhao = :ema and placa_caminhao = :pla", "ema={$data["renavam"]}&pla={$data["placa"]}")->fetch(true);
    if (isset($renavam_caminhao)) {
        $_SESSION["decline_car"] = "O caminhão já possui cadastro no sistema!";
        $router->redirect("app/editcar");
        die();
    }
    $caminhao = new Caminhao();
    $caminhao->id_motorista = $data["driver_id"];
    $caminhao->placa_caminhao = $data["placa"];
    $caminhao->renavam_caminhao = $data["renavam"];
    $caminhao->modelo = $data["modelo"];
    $caminhao->cor = $data["cor"];
    $caminhao->tipo_caminhao = $data["tipo"];
    $caminhao->save();

    $relacao_caminhao = new Relacao_Caminhao();
    $relacao_caminhao->id_motorista = $data["driver_id"];
    $relacao_caminhao->id_caminhao = $caminhao->id;
    $relacao_caminhao->save();
    
if ($caminhao->save()) {

    $_SESSION["save_car"] = "Caminhao adicionado com sucesso!";
    $router->redirect("app/editcar");
}else{
    $_SESSION["decline_car"] = "Verifique se tudo foi preenchido corretamente!";
    $router->redirect("app/editcar");
}
