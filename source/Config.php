<?php
include __DIR__ . "/../vendor/autoload.php";

define("URL_BASE", "http://localhost/mvcc/");

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "transdoni",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
    ],
]);

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "transdoni");

define("MAIL", [
    "host" => "smtp.gmail.com",
    "port" => "587",
    "user" => "financeiro@softgbs.com",
    "passwd" => "tetratonica",
    "from_name" => "Gustavo Bomfim",
    "from_email" => "gbomfim@softgbs.com",
]);

function url(string $path = null): string
{
    if ($path) {
        return URL_BASE . "{$path}";
    }
    return URL_BASE;
}
