<?php

use CoffeeCode\Router\Router;
use Source\Models\User;

$router = new Router(URL_BASE);

$user = (new User())->findById("{$data["id"]}");

if($user){

    if (password_verify($data["senha_atual"], $user->password)) {

        if($data["senha_nova"] != $data["repete_senha"]){

            $_SESSION["decline_msg"] = "Confirmação de senha inválida, verifique se digitou e repetiu corretamente!";
            $router->redirect("console/perfil");
            die();
          
        }else{
            $user->password = password_hash("{$data["senha_nova"]}", PASSWORD_DEFAULT);
            $user->save();
       }

    }else{
        $_SESSION["decline_msg"] = "Senha atual inválida, tente novamente!";
        $router->redirect("console/perfil");
        die();

    }
    

    if($user->save() != false){
        
        $_SESSION["success_msg"] = "Senha Atualizada com sucesso: -> {$data["senha_nova"]}!";
        $router->redirect("console/perfil");
    }else{
        $_SESSION["decline_msg"] = "Houve um erro na solicitação!";
        $router->redirect("console/perfil");

    }
}