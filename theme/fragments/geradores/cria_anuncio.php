<?php

use CoffeeCode\Router\Router;
use Source\Models\Anuncios;

$router = new Router(URL_BASE);

$dataF = new DateTime($data["data"]);

$nomeCliente = (new \Source\Models\Clients())->find("id = :ids","ids={$data["cliente"]}")->fetch(true);

$anuncio = new Anuncios();
$anuncio->id_cliente = $data["cliente"];
$anuncio->id_anuncio = $data["ref_fornecedor"];
$anuncio->fornecedor = $data["fornecedor"];
$anuncio->link = $data["link"];
$anuncio->dt_anuncio = $data["data"];
$anuncio->valor = $dataF->format("Y-m-d");
$anuncio->description = $data["descricao"];
$anuncio->save();

//echo "<pre>", var_dump($nomeCliente["0"]->razao), "</pre>";

return $router->redirect("/console/clientes/{$nomeCliente["0"]->razao}/{$data["cliente"]}");