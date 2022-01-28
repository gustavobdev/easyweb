<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;
use Source\Models\Address;


$user = new User();
$user->first_name = "Silvio";
$user->last_name = "Sebastião";
$user->genere = "M";
$user->save();

$addr = new Address();
$addr->add($user,"Jornalisa Paulo Matos", "239");
$addr->save();

var_dump($user);
