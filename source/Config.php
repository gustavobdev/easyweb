<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include __DIR__ . "/../vendor/autoload.php";

define("URL_BASE", "https://transdonis.herokuapp.com/");

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "us-cdbr-east-05.cleardb.net",
    "port" => "3306",
    "dbname" => "heroku_7032aea5d830706",
    "username" => "baa3387beae7ff",
    "passwd" => "6d5d9f0c",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
    ],
]);
date_default_timezone_set('America/Sao_Paulo');

define("HOST", "us-cdbr-east-05.cleardb.net");
define("USER", "baa3387beae7ff");
define("PASS", "6d5d9f0c");
define("DB", "heroku_7032aea5d830706");

/**
 * @return PHPMailer
 */
function getSend(): PHPMailer
{
    $send = new PHPMailer();
    $send->isSMTP();
    $send->setLanguage("br");
    $send->SMTPDebug = false;
    $send->Host = 'smtp.gmail.com';
    $send->Port = 465;
    $send->SMTPSecure = "ssl";
    $send->SMTPAuth = true;
    $send->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $send->Username = 'esayfreight@gmail.com';
    $send->Password = 'Santos-13';
    return $send;
}



function url(string $path = null): string
{
    if ($path) {
        return URL_BASE . "{$path}";
    }
    return URL_BASE;
}
