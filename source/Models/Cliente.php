<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Cliente extends DataLayer
{
    public function __construct()
    {
        parent::__construct("cliente", []);
    }
}