<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Estados extends DataLayer
{
    public function __construct()
    {
        parent::__construct("estados",[],false);
    }

}