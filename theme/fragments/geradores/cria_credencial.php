<?php

use CoffeeCode\Router\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Source\Models\Credentials;

$router = new Router(URL_BASE);

$credential = new Credentials();
$credential->id_cliente = $data["cliente"];
$credential->servico = $data["servico"];
$credential->link = $data["link"];
$credential->login = $data["login"];
$credential->senha = $data["senha"];
$credential->obs = $data["obs"];
$credential->save();


//echo "<pre>", var_dump($user), "</pre>";

return $router->redirect("/console");