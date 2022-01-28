<?php

use CoffeeCode\Router\Router;
use Source\Models\Builds;

$router = new Router(URL_BASE);

$cliente = (new \Source\Models\Clients())->find("id = :lid","lid={$data["cliente"]}")->fetch(true);

$dataF = new DateTime($data["vencimento"]);
//$dataB = new DateTime($data["baixa"]);

$build = new Builds();
$build->nosso_numero = $data["nosso_numero"];
$build->id_cliente = $data["cliente"];
$build->vencimento = $dataF->format("Y-m-d");
//$build->data_pagto = $dataB->format("Y-m-d");
$build->status = $data["status"];
$build->valor = $data["valor"];
$build->description = $data["descricao"];
$build->save();

//echo "<pre>" ,var_dump($build), "</pre>";


$router->redirect("/console/clientes/{$cliente["0"]->razao}/{$cliente["0"]->id}");