<?php


namespace Source\Models;
use CoffeeCode\DataLayer\DataLayer;

class Clients extends DataLayer
{
    public function __construct()
    {
        parent::__construct("clientes", ["razao","cnpj"]);
    }

    public function projects()
    {
        return (new Projetcs())->find("id_cliente = :uid","uid={$this->id}")->count();
    }

    public function status_fatura()
    {
        return (new Build_status())->find()->fetch(true);
    }

    public function anuncios()
    {
        return (new Anuncios())->find("id_cliente = :aid", "aid={$this->id}")->fetch();
    }

    public function horas()
    {

    }
}