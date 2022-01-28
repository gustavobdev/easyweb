<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Anuncios extends DataLayer
{
    public function __construct()
    {
        parent::__construct("anuncios", ["id_cliente"]);
    }


}