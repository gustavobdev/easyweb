<?php
if (!isset($_SESSION)) {
    session_start();
}

use CoffeeCode\Router\Router;
use Source\Models\reboque;
use Source\Models\Relacao_Reboque;

$router = new Router(URL_BASE);


$router = new Router(URL_BASE);

foreach ($data as $key => $value) {
    if (empty($value) or is_null($value)) {
        $_SESSION["decline_car"] = "Dados incompletos! por favor adicione todas as informações";
        $router->redirect("app/editreboque");
        die();
    }
}

$renavam_reboque = (new Reboque())->find("renavam_reboque = :ema and placa_reboque = :pla", "ema={$data["renavam"]}&pla={$data["placa"]}")->fetch(true);
if (isset($renavam_reboque)) {
    $_SESSION["decline_car"] = "O reboque já possui cadastro no sistema!";
    $router->redirect("app/editreboque");
    die();
}
$reboque = new Reboque();
$reboque->id_motorista = $data["driver_id"];
$reboque->placa_reboque = $data["placa"];
$reboque->renavam_reboque = $data["renavam"];
$reboque->tipo_reboque = $data["tipo"];
$reboque->save();
$relacao_reboque = new Relacao_Reboque();
$relacao_reboque->id_motorista = $data["driver_id"];
$relacao_reboque->id_reboque = $reboque->id;
$relacao_reboque->save();



if ($reboque->save()) {

    $_SESSION["save_reboque"] = "Reboque adicionado com sucesso!";
    $router->redirect("app/editreboque");
} else {
    $_SESSION["decline_reboque"] = "Verifique se tudo foi preenchido corretamente!";
    $router->redirect("app/editreboque");
}
