<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Build_status extends DataLayer
{
    public function __construct()
    {
        parent::__construct("status_fatura", ["desc_status"], "id", false);
    }
}