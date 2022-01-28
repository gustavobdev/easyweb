<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Relacao_Caminhao extends DataLayer
{
    public function __construct()
    {
        parent::__construct("relacao_caminhao", ["id_motorista", "id_caminhao"],"id", false);
    }
    public function caminhao()
    {
        return (new Caminhao())->find("id = :idr","idr={$this->id_caminhao}")->fetch(true);
    }

}