<?php

use CoffeeCode\Router\Router;
use Source\Models\Projetcs;


$router = new Router(URL_BASE);

$project = new Projetcs();
$project->id_cliente = $data["cliente"];
$project->nome = $data["projeto"];
$project->decricao = $data["descricao"];
$project->save();

$router->redirect("/console/projetos");