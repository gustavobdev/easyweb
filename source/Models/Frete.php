<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Frete extends DataLayer
{
    public function __construct()
    {
        parent::__construct("frete", []);
    }

    public function motoristas()
    {
        return (new Motorista())->find("id = :mid","mid={$this->motorista}")->fetch(true);
    }
    public function caminhao()
    {
        $motorista = (new Motorista())->find("id = :mid","mid={$this->motorista}")->fetch(true);
        return (new Caminhao())->find("id = :cid","cid={$motorista[0]->id_caminhao}")->fetch(true);
    }

    public function reboque()
    {
        $motorista = (new Motorista())->find("id = :mid","mid={$this->motorista}")->fetch(true);
        return (new Reboque())->find("id = :ird","rid={$motorista[0]->id_reboque}")->fetch(true);

    }

    public function status_fretes()
    {
        return (new Status_frete())->find("id = :sid","sid={$this->status_frete}")->fetch(true);
    }

    public function clientes()
    {
        return (new Cliente())->find("id = :cid","cid={$this->cliente_transportadora}")->fetch(true);
    }
    public function origem_city()
    {
        return (new Cidades())->find("id = :xid","xid={$this->origem_cidade}")->fetch(true);
    }
    public function uf_origem()
    {
        return (new Estados())->find("id = :uid","uid={$this->origem_uf}")->fetch(true);
    }
    public function retirada_ch_vz()
    {
        return (new Cidades())->find("id = :uid","uid={$this->retirada_cheio_vazio_cidade}")->fetch(true);
    }
    public function retirada_ch_vz_uf()
    {
        return (new Estados())->find("id = :uid","uid={$this->retirada_cheio_vazio_uf}")->fetch(true);
    }
    public function destino_city()
    {
        return (new Cidades())->find("id = :uid","uid={$this->destino_cidade}")->fetch(true);
    }
    public function destin_uf()
    {
        return (new Estados())->find("id = :uid","uid={$this->destino_uf}")->fetch(true);
    }
    public function deposito_ch_vz()
    {
        return (new Cidades())->find("id = :uid","uid={$this->deposito_cheio_vazio_cidade}")->fetch(true);
    }
    public function deposito_ch_vz_uf()
    {
        return (new Estados())->find("id = :uid", "uid={$this->deposito_cheio_vazio_uf}")->fetch(true);
    }
    public function pdf()
    {
        return (new Docfrete())->find("id_frete = :uid", "uid={$this->id}")->fetch(true);
    }
}