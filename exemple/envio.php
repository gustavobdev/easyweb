<?php
require __DIR__ . "/../vendor/autoload.php";

$email = new \Source\Support\Email();

$email->add(
    "Olá Mundo esse é meu primeiro Email",
    "<h1>Estou apenas testando, espero que tenha dado certo</h1>",
    "Gustavo bomfim",
    "gustavo.bomfim@grupo-tribuna.com"
)->send();

if (!$email->error()){
    var_dump(true);
}else{
    echo $email->error()->getMessage();
}
