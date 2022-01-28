<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Banco extends DataLayer
{
    public function __construct()
    {
        parent::__construct("bancos", ["cod"]);
    }
}
