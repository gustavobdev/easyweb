<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Pdf_Frete extends DataLayer
{
    public function __construct()
    {
        parent::__construct("pdf_frete", ["id_frete", "caminho"], "id", false);
    }
    public function pdf()
    {
        return (new Frete())->find("id = :uid", "uid={$this->id_frete}")->fetch(true);
    }
    public function clientes()
    {
        $frete = (new Frete())->find("id = :uid", "uid={$this->id_frete}")->fetch(true);

        return (new Cliente())->find("id = :cid", "cid={$frete[0]->cliente_transportadora}")->fetch(true);
    }
}
