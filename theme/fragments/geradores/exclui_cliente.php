<?php
if(!isset($_SESSION)){
    session_start();
}

use Source\Models\Cliente;

$client = (new Cliente())->findById("{$data["id"]}");

if(isset($client))
{
    $client->destroy();
}
if($client->destroy() != false){
    $msg = "Cliente {$client->razao_social} foi excluido do sistema";
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