<?php

use CoffeeCode\Router\Router;
use Source\Models\Motorista;
use CoffeeCode\Uploader\Image;
 use Source\Models\UploadImagem;
$router = new Router(URL_BASE);

if (!isset($_SESSION)) {
    session_start();
}
$driver = $_SESSION["driver_id"];
$name = $_SESSION["driver_first_name"] . '-' . $_SESSION["driver_last_name"];
$photo = $_FILES['image'];
$profile = (new Motorista())->findById($_SESSION["driver_id"]);
$arquivo = $profile->profile_photo;

/*
$image = new Image("uploads", "users/profileimg", false);
$profile = (new Motorista())->findById($_SESSION["driver_id"]);
$arquivo = $profile->profile_photo;


if ($_FILES) {
    if (file_exists($arquivo)) {
        unlink($arquivo);
    }
    try {
        $upload = $image->upload($_FILES['image'], $_SESSION["driver_first_name"] . '-' . $_SESSION["driver_last_name"]);
        $profile->profile_photo = $upload;
        $profile->save();
        $_SESSION["profile_photo"] = null;
        $_SESSION["profile_photo"] = $upload;
        $_SESSION["save_perfil"] = "Foto de Perfil alterada com sucesso!";
        $router->redirect("app/perfil");
    } catch (Exception $e) {
        echo "<p>(!) {$e->getMessage()}</p>";
        $_SESSION["decline_perfil"] = "Houve um erro ao alterar a imagem, tente novamente mais tarde.";
        $profile->profile_photo = null;
        $profile->save();
        $router->redirect("app/perfil");
    }
} else {
    $_SESSION["decline_perfil"] = "Houve um erro ao alterar a imagem, tente novamente mais tarde.";
    $router->redirect("app/perfil");
}
*/

if (!empty($_FILES)) { // Se o array $_FILES não estiver vazio
    
    if (file_exists($arquivo)) {
        unlink($arquivo);
    }
    // Associamos a classe à variável $upload
    $upload = new UploadImagem();
    // Determinamos nossa largura máxima permitida para a imagem
    $upload->width = 354;
    // Determinamos nossa altura máxima permitida para a imagem
    $upload->height = 472;

// Exibimos a mensagem com sucesso ou erro retornada pela função salvar.
//Se for sucesso, a mensagem também é um link para a imagem enviada.

    echo $upload->salvar("Motorista", "id", $driver,"profile_photo","uploads/users/profileimg/", $photo,"imgprofile", "profile_photo");
    $router->redirect("app/perfil");

}