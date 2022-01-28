<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Candidaturas extends DataLayer
{
    public function __construct()
    {
        parent::__construct("candidatura", []);
    }

    public function motoristas()
    {
        return (new Motorista())->find("id = :mid","mid={$this->motorista}")->fetch(true);
    }

    public function fretes()
    {
        return (new Frete())->find("id = :fid","fid={$this->frete_id}")->fetch(true);
        
    }
    public function statu()
    {
        return (new Status_candidatura())->find("id = :sid","sid={$this->status}")->fetch(true);
    }


    public function origem_city()
    {
        $frete = (new Frete())->find("id = :fid", "fid={$this->frete_id}")->fetch(true);
        return (new Cidades())->find("id = :xid", "xid={$frete[0]->origem_cidade}")->fetch(true);
    }
    public function uf_origem()
    {
        $frete = (new Frete())->find("id = :fid", "fid={$this->frete_id}")->fetch(true);
        return (new Estados())->find("id = :uid", "uid={$frete[0]->origem_uf}")->fetch(true);
    }
    public function retirada_ch_vz()
    {
        return (new Cidades())->find("id = :uid", "uid={$this->retirada_cheio_vazio_cidade}")->fetch(true);
    }
    public function retirada_ch_vz_uf()
    {
        return (new Estados())->find("id = :uid", "uid={$this->retirada_cheio_vazio_uf}")->fetch(true);
    }
    public function destino_city()
    {
        $frete = (new Frete())->find("id = :fid", "fid={$this->frete_id}")->fetch(true);
        return (new Cidades())->find("id = :uid", "uid={$frete[0]->destino_cidade}")->fetch(true);
    }
    public function destin_uf()
    {
        $frete = (new Frete())->find("id = :fid", "fid={$this->frete_id}")->fetch(true);
        return (new Estados())->find("id = :uid", "uid={$frete[0]->destino_uf}")->fetch(true);
    }
    public function deposito_ch_vz()
    {
        return (new Cidades())->find("id = :uid", "uid={$this->deposito_cheio_vazio_cidade}")->fetch(true);
    }
    public function deposito_ch_vz_uf()
    {
        return (new Estados())->find("id = :uid", "uid={$this->deposito_cheio_vazio_uf}")->fetch(true);
    }


}