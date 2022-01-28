<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Entregas extends DataLayer
{
    public function __construct()
    {
        parent::__construct("entregas", ["id_projeto","tema","horas","description","id_user"]);
    }
}