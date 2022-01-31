<?php

use CoffeeCode\Router\Router;
use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Image;
use Source\Models\Multas;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

if (isset($data["id_caminhao"])) {

    $verifica = (new Multas())->find("numero_doc = :num", "num={$data["numero_doc"]}")->fetch(true);

    if (isset($verifica)) {

        $_SESSION["decline_msg"] = "Já existe cadastro com esse número!";
        $router->redirect("console/multas");
        die();
    }

    $file = new File("uploads", "multas", false);

    if ($_FILES) {
        try {
            $upload = $file->upload($_FILES['docmulta'], $data['namedoc']);

            $multas = new Multas();
            $multas->id_caminhao = $data["id_caminhao"];
            $multas->id_reboque = null;
            $multas->id_operador = $data["id_operador"];
            $multas->id_motorista = $data["driver_id"];
            $multas->data_vencto = $data["data_vencto"];
            $multas->valor = $data["valor_multa"];
            $multas->doc = $upload;
            $multas->numero_doc = $data["numero_doc"];

            if (isset($data["data_pagto"]) xor !empty($data["data_pagto"]) xor !is_null($data["data_pagto"])) {
                $multas->data_pagto = $data["data_pagto"];
            } 
            
            if (isset($data["obs_multa"]) xor !empty($data["obs_multa"]) xor !is_null($data["obs_multa"])) {
                $multas->obs = $data["obs_multa"];
            } 
            $multas->save();

            if ($multas->save() != false) {

                $_SESSION["success_msg"] = "Multa registrada com sucesso!";
                $router->redirect("console/multas");
            }
        } catch (Exception $e) {

            $_SESSION["decline_msg"] = "Erro:  {$e->getMessage()}";
            $router->redirect("console/multas");
            echo "<p>(!) {$e->getMessage()}</p>";
        }
    }
}
if(isset($data["id_reboque"])){


    $verifica = (new Multas())->find("numero_doc = :num", "num={$data["numero_doc"]}")->fetch(true);

    if (isset($verifica)) {

        $_SESSION["decline_msg"] = "Já existe cadastro com esse número!";
        $router->redirect("console/multas");
        die();
    }

    $file = new File("uploads", "multas", false);

    if ($_FILES) {
        try {
            $upload = $file->upload($_FILES['docmultaa'], $data['namedocc']);

            $multas = new Multas();
            $multas->id_caminhao = null;
            $multas->id_reboque = $data["id_reboque"];
            $multas->id_operador = $data["id_operador"];
            $multas->id_motorista = $data["driver_id"];
            $multas->data_vencto = $data["data_vencto"];
            $multas->valor = $data["valor_multa"];
            $multas->doc = $upload;
            $multas->numero_doc = $data["numero_doc"];

            if (isset($data["data_pagto"]) xor !empty($data["data_pagto"]) xor !is_null($data["data_pagto"])) {
                $multas->data_pagto = $data["data_pagto"];
            } 
            
            if (isset($data["obs_multa"]) xor !empty($data["obs_multa"]) xor !is_null($data["obs_multa"])) {
                $multas->obs = $data["obs_multa"];
            } 
            $multas->save();

            if ($multas->save() != false) {

                $_SESSION["success_msg"] = "Multa reboque registrada com sucesso!";
                $router->redirect("console/multas");
            }
        } catch (Exception $e) {

            $_SESSION["decline_msg"] = "Erro:  {$e->getMessage()}";
            $router->redirect("console/multas");
            echo "<p>(!) {$e->getMessage()}</p>";
        }
    }
}
