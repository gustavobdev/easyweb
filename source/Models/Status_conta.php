<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Status_conta extends DataLayer
{
    public function __construct()
    {
        parent::__construct("statusconta_desc",[]);
    }
}