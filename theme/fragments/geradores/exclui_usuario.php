<?php
if(!isset($_SESSION)){
    session_start();
}
use Source\Models\User;

$user = (new User())->findById("{$data["id"]}");

if(isset($user))
{
if($user->id === $_SESSION["user_id"]){

    $msg = "Você não pode se auto-excluir!";
    echo json_encode(array(
        "msg" => $msg,
        "icon" => "error",
        "title" => "OOPS!"
    ));
    die();
}else{
    $user->destroy();
}
}
if($user->destroy() != false){
    $msg = "Usuário {$user->nome} foi excluido do sistema";
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