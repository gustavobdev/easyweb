<?php

use CoffeeCode\Router\Router;
use Source\Models\Motorista;
use CoffeeCode\Uploader\Image;

$router = new  Router(URL_BASE);
$image = new Image("uploads", "users/profileimg", false);
$profile = (new Motorista())->findById("{$data["driver_id"]}");

if (!isset($_SESSION)) {
    session_start();
}
if ($data) {
    foreach ($data as $key => $value) {
        if (empty($value) or is_null($value)) {
            $_SESSION["decline_perfil"] = "Dados incompletos! por favor adicione todas as informações";
            $router->redirect("app/perfil");
            die();
        }
    }
}
if (empty($data["phone1"]) xor is_null($data["phone1"]) && empty($data["phone2"]) xor is_null($data["phone2"])) {

    $_SESSION["decline_perfil"] = "Digite ao menos um número de telefone!";
    $router->redirect("app/perfil");
    die();
} else {

    if (empty($data["phone1"]) xor is_null($data["phone1"])) {
        $data["phone1"] = "000";
    } elseif (empty($data["phone2"]) xor is_null($data["phone2"])) {
        $data["phone2"] = "000";
    }
    $profile->nome = $data["nome"];
    $profile->sobrenome = $data["sobrenome"];
    $profile->cpf = $data["cpf"];
    $profile->email = $data["email"];
    $profile->telefone1 = $data["phone1"];
    $profile->telefone2 = $data["phone2"];
    $profile->save();
}
if ($profile->save()) {
    $_SESSION["save_perfil"] = "Perfil atualizado com sucesso!";
    $_SESSION["profile_photo"] = $profile->profile_photo;
    $_SESSION["driver_first_name"] = $profile->nome;
    $_SESSION["driver_last_name"] = $profile->sobrenome;
    $_SESSION["driver_email"] = $profile->email;
    $_SESSION["driver_cpf"] = $profile->cpf;
    $_SESSION["driver_fone1"] = $profile->telefone1;
    $_SESSION["driver_fone2"] = $profile->telefone2;
    $router->redirect("app/perfil");
}
