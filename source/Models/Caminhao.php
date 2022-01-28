<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Caminhao extends DataLayer
{
    public function __construct()
    {
        parent::__construct("caminhao", []);
    }
    public function reboque()
    {
        return (new Reboque())->find("id_motorista = :idc", "idc={$this->id_motorista}")->fetch(true);

    }
    public function driver()
    {
        return (new Motorista())->find("id_motorista = :idc", "idc={$this->id_motorista}")->fetch(true);


    }
}
