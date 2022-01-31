<?php

use CoffeeCode\Router\Router;
use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Image;
use Source\Models\Multas;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

if (isset($data["id_multa"])) {

    $multas = (new Multas())->findById("{$data["id_multa"]}");
    echo "<pre>", var_dump($data), "</pre>";

    if (isset($multas)) {

        if (isset($data["driver_veh"]) xor !empty($data["driver_veh"]) xor !is_null($data["driver_veh"])) {
            $multas->id_motorista = $data["driver_veh"];
        }

        if (isset($data["numero_doc1"]) xor !empty($data["numero_doc1"]) xor !is_null($data["numero_doc1"])) {
            $multas->numero_doc = $data["numero_doc1"];
        }

        if (isset($data["data_vencto1"]) xor !empty($data["data_vencto1"]) xor !is_null($data["data_vencto1"])) {
            $multas->data_vencto = $data["data_vencto1"];
        }

        if (isset($data["data_pagto1"]) xor !empty($data["data_pagto1"]) xor !is_null($data["data_pagto1"])) {
            $multas->data_pagto = $data["data_pagto1"];
        }

        if (isset($data["valor_multa1"]) xor !empty($data["valor_multa1"]) xor !is_null($data["valor_multa1"])) {
            $multas->valor = $data["valor_multa1"];
        }

        if (isset($data["obs_multa1"]) xor !empty($data["obs_multa1"]) xor !is_null($data["obs_multa1"])) {
            $multas->obs = $data["obs_multa1"];
        }
        $multas->save();

        if ($multas->save() != false) {

            $_SESSION["success_msg"] = "Multa Atualizada com sucesso!";
            $router->redirect("console/multas");
        }
    }
}
