<?php

use CoffeeCode\Router\Router;
use Source\Models\Candidaturas;

$router = new Router(URL_BASE);

$candidatura = new Candidaturas();

$candidatura->frete_id = $data["id_frete"];
$candidatura->motorista = $data["id_motorista"];
$candidatura->status = 1;
$candidatura->save();

$router->redirect("/app");

