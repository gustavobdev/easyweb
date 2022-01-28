<?php

require __DIR__ . "/../../vendor/autoload.php";

$projeto = new \Source\Models\Projetcs();
$projeto->id_cliente = 2;
$projeto->nome = "teste";
$projeto->decricao = "Esse é só um teste";
$projeto->save();

var_dump($projeto);