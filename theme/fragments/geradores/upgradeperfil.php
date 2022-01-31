<?php

use CoffeeCode\Router\Router;
use Source\Models\User;

$router = new Router(URL_BASE);

$user = (new User())->findById("{$data["id"]}");

if($user){

    $user->nome = $data["nome"];
    $user->sobrenome = $data["sobrenome"];
    $user->email = $data["email"];
    $user->save();

    if($user->save() != false){
        
        $_SESSION["nome"] = $user->nome;
        $_SESSION["sobrenome"] = $user->sobrenome;
        $_SESSION["email"] = $user->email;
        $_SESSION["success_msg"] = "Perfil Atualizado com sucesso!";
        $router->redirect("console/perfil");
    }else{
        $_SESSION["decline_msg"] = "Houve um erro na solicitação!";
        $router->redirect("console/perfil");

    }
}