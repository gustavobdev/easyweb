<?php

use CoffeeCode\Router\Router;
use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Image;
use Source\Models\Docfrete;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

if (isset($data["idfrete_doc"])) {


    $file = new File("uploads", "docfrete", false);

    if ($_FILES) {
        try {
            $upload = $file->upload($_FILES['caminho_doc'], $data['titulo_doc']);

            $docfrete = new Docfrete();
            $docfrete->id_frete = $data["idfrete_doc"];
            $docfrete->titulo = $data["titulo_doc"];
            $docfrete->categoria = $data["categoria_doc"];
            $docfrete->docfrete = $upload;
            $docfrete->save();

            if ($docfrete->save() != false) {

                $_SESSION["success_frete"] = "Upload feito com sucesso!";
                $router->redirect("console/fretes/{$data["idfrete_doc"]}");
            }
        } catch (Exception $e) {

            $_SESSION["decline_frete"] = "Erro:  {$e->getMessage()}";
            $router->redirect("console/fretes/{$data["idfrete_doc"]}");
            echo "<p>(!) {$e->getMessage()}</p>";
        }
    }
}
