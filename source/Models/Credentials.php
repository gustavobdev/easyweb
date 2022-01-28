<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Credentials extends DataLayer
{
    public function __construct()
    {
        parent::__construct("credentials",["servico"]);
    }
}