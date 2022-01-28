<?php
if(!isset($_SESSION)){
    session_start();
}
use Source\Models\Multas;

$multa = (new Multas())->findById("{$data["id"]}");

if(isset($multa))
{

    $multa->destroy();

}
if($multa->destroy() != false){
    $msg = "Multa excluida do sistema";
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