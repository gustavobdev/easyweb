<?php

use CoffeeCode\Router\Router;
use Source\Models\Entregas;

$router = new Router(URL_BASE);

$dataF = new DateTime($data["data"]);

$entrega = new Entregas();
$entrega->id_projeto = $data['id'];
$entrega->tema = $data['tema'];
$entrega->horas = $data["hora"];
$entrega->dt_entrega = $dataF->format("Y-m-d");
$entrega->id_user = 1;
$entrega->description = $data["descricao"];
$entrega->save();

$router->redirect("/console/edit/{$data['projeto']}/{$data['id']}");