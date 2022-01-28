<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Builds extends DataLayer
{
    public function __construct()
    {
        parent::__construct("faturas", ["id_cliente","status","valor"]);
    }

    public function status_fatura()
    {
        return (new Build_status())->find("id = :uid","uid={$this->status}","desc_status")->fetch();
    }

    public function clients()
    {
        return (new Clients())->find("id = :cid","cid={$this->id_cliente}","razao")->fetch();
    }



}