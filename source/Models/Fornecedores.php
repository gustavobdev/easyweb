<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Fornecedores extends DataLayer
{
    public function __construct()
    {
        parent::__construct("fornecedores", ["nome"], "id", false);
    }
}