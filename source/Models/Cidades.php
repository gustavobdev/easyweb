<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Cidades extends DataLayer
{
    public function __construct()
    {
        parent::__construct("cidades",[],false);
    }

}