<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Reboque extends DataLayer
{
    public function __construct()
    {
        parent::__construct("reboque",[]);
    }
    public function motorista()
    {
        return (new Motorista())->find("id = :idr","idr={$this->id_motorista}")->fetch(true);
    }
}