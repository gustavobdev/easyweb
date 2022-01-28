<?php
use CoffeeCode\Router\Router;
$router = new Router(URL_BASE);
session_start();
session_destroy();

$router->redirect("app/login");