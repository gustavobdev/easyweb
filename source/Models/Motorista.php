<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Motorista extends DataLayer
{
    public function __construct()
    {
        parent::__construct("motorista",[]);
    }
    public function caminhao()
    {
        return (new Caminhao())->find("id = :idr","idr={$this->id_caminhao}")->fetch(true);
    }
    public function reboque()
    {
        return (new Reboque())->find("id = :idr","idr={$this->id_reboque}")->fetch(true);
    }

    public function status()
    {
        return (new Status_conta())->find("id = :idr","idr={$this->status_conta}")->fetch(true);
    }



}