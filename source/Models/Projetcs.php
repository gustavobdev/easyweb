<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Projetcs extends DataLayer
{
    public function __construct()
    {
        parent::__construct("projetos", ["id_cliente","nome"]);
    }

    public function addi(Clients $cliente, string $nome, string $descricao): Projetcs
    {
        $this->id_cliente = $cliente->id;
        $this->nome = $nome;
        $this->decricao = $descricao;

        return $this;
    }

    public function clients()
    {
        return (new Clients())->find("id = :uid","uid={$this->id_cliente}")->fetch(true);
    }

    public function entregas()
    {
        return (new Entregas())->find("id_projeto = :eid", "eid={$this->id}")->count();
    }

    public function horas()
    {
       $horas = (new Entregas())->find("id_projeto = :eid", "eid={$this->id}")->fetch(true);
       $total = 0;
       foreach ($horas as $hora) {
            $total = $total + $hora->horas;
       }

       return $total." horas";
    }
}