<?php

namespace Source\App\Rush;


use League\Plates\Engine;
use Source\Models\Anuncios;
use Source\Models\Builds;
use Source\Models\Entregas;
use Source\Models\Projetcs;
use function React\Promise\all;

session_start();

class Controller
{

    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../../theme");
    }

    public function home()
    {
        $projetos = (new Projetcs())->find("id_cliente = :ois","ois={$_SESSION["id_cliente"]}")->fetch(true);
        echo $this->view->render("/rush/home",[
            "tible" => "home",
            "projetos" => $projetos
        ]);
    }

    public function projetos()
    {
        $projetos = (new Projetcs())->find("id_cliente = :lid","lid={$_SESSION["id_cliente"]}")->fetch(true);
        echo $this->view->render("/rush/projetos",[
            "projects" => $projetos
        ]);
    }

    public function anuncios()
    {
        $anuncios = (new Anuncios())->find("id_cliente = :lid","lid={$_SESSION["id_cliente"]}")->fetch(true);
        echo $this->view->render("/rush/anuncios",[
            "anuncios" => $anuncios
        ]);
    }

    public function faturas()
    {
        $faturas = (new Builds())->find("id_cliente = :lid","lid={$_SESSION["id_cliente"]}")->fetch(true);
        echo $this->view->render("/rush/faturas",[
            "builds" => $faturas
        ]);
    }


}