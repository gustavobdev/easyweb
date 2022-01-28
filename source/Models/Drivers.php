<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Drivers extends DataLayer
{
    public function __construct()
    {
        parent::__construct("driver",["email"]);
    }
}