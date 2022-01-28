<?php


namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Relacao_Reboque extends DataLayer
{
    public function __construct()
    {
        parent::__construct("relacao_reboque", ["id_motorista", "id_reboque"],"id", false);
    }
    public function reboque()
    {
        return (new Reboque())->find("id = :idr","idr={$this->id_reboque}")->fetch(true);
    }

}