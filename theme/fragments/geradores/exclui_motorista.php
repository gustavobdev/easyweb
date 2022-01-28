<?php
if(!isset($_SESSION)){
    session_start();
}
use Source\Models\Motorista;

$motorista = (new Motorista())->findById("{$data["id"]}");

if(isset($motorista))
{

    $motorista->destroy();

}
if($motorista->destroy() != false){
    $msg = "Caminhoneiro {$motorista->nome} foi excluido do sistema";
    echo json_encode(array(
        "msg" => $msg,
        "icon" => "success",
        "title" => "Feito!",
        "success" => "success"
    ));
}else{
    $msg = "Erro ao processar solicitação";
    echo json_encode(array(
        "msg" => $msg,
        "icon" => "error",
        "title" => "OOPS!"
    ));

}