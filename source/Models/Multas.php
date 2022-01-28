<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Multas extends DataLayer
{
    public function __construct()
    {
        parent::__construct("multas",[], "id");
    }

    public function motorista(){

        return (new Motorista())->findById("{$this->id_motorista}");
    }
    public function caminhao(){

        return (new Caminhao())->find("id = :cid","cid={$this->id_caminhao}")->fetch(true);
    }
    public function reboque(){

        return (new Reboque())->find("id = :cid","cid={$this->id_reboque}")->fetch(true);
    }
}