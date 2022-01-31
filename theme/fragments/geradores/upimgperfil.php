<?php

use CoffeeCode\Router\Router;
 use Source\Models\UpImagem;
use Source\Models\User;

$router = new Router(URL_BASE);

if (!isset($_SESSION)) {
    session_start();
}

$user = $_SESSION["user_id"];
$name = $_SESSION["nome"] . '-' . $_SESSION["sobrenome"];
$photo = $_FILES['uploadimg'];
$profile = (new User())->findById($_SESSION["user_id"]);
$arquivo = $profile->profile_photo;


if (!empty($_FILES)) { // Se o array $_FILES não estiver vazio
    
    if (file_exists($arquivo)) {
        unlink($arquivo);
    }
    // Associamos a classe à variável $upload
    $upload = new UpImagem();
    // Determinamos nossa largura máxima permitida para a imagem
    $upload->width = 354;
    // Determinamos nossa altura máxima permitida para a imagem
    $upload->height = 472;

// Exibimos a mensagem com sucesso ou erro retornada pela função salvar.
//Se for sucesso, a mensagem também é um link para a imagem enviada.

    echo $upload->salvar("User", "id", $user,"profile_photo","uploads/dashboard/users/profileimg/", $_FILES['uploadimg'], "img_profile", "imgprofile");
    $router->redirect("console/perfil");

}