<?php

namespace Source\App\Landing;

use CoffeeCode\Router\Router;
use League\Plates\Engine;
use Source\Models\Frete;

use Source\Models\Relacao_Caminhao;
use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Reboque;

class Web
{
    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../../theme");
        $this->view->addData(['company' => 'Transdoni - Transporte & Logística em Santos'], '_theme');
        $this->view->addData(['company' => 'Transdoni - Transporte & Logística em Santos'], '_theme2');
    }

    /**
     * @param  $data
     */
    public function home()
    {
        echo $this->view->render("home", [
            "title" => "Home"
        ]);
    }

    public function tracking($data)
    {
        echo $this->view->render("fragments/geradores/tracking", [
            "data" => $data
        ]);
    }

    public function rastrear($data)
    {
        $router = new Router(URL_BASE);
        $frete = (new Frete())->find("doc_viagem_cte = :doc", "doc={$data["tracking"]}")->fetch(true);
        if ($frete) {
            if($frete[0]->status_frete === "6"){

            echo $this->view->render("rastreio", [
                "frete" => $frete,
                "title" => "CTE Nº " . $frete[0]->doc_viagem_cte
            ]);
        }else{
            unset($_SESSION["statusfail"]);
            $_SESSION["statusfail"] = "Frete existente, porém não publicado, aguarde!";
            $router->redirect("/");
        }
        } else {
            unset($_SESSION["statusfail"]);
            $_SESSION["statusfail"] = "Número de CTE inválido!";
            $router->redirect("/");
        }
    }
    public function contact($data)
    {
        echo "<h1>Contato</h1>";
        var_dump($data);
        $url = URL_BASE;
        require __DIR__ . "/../../../theme/contact.php";
    }

    public function blog()
    {
        require __DIR__ . "/../../../theme/blog.php";
    }

    public function post($data)
    {
        echo "<h1>Web Article</h1>";
        var_dump($data);
    }

    public function category($data)
    {
        echo "<h1>Web Category</h1>";
        var_dump($data);
    }

    public function generate_post($data)
    {
        require __DIR__ . "/../../theme/sample/generate_post.php";
    }

    public function generate_user($data)
    {
        require __DIR__ . "/../../exemple/create.php";
    }

    public function error($data)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["nome"])) {
            echo $this->view->render("error", [
                "title" => "Erro {$data['errcode']}",
                "error" => $data["errcode"]
            ]);
        } elseif (isset($_SESSION["driver_first_name"])) {
            echo $this->view->render("app/error", [
                "title" => "Erro {$data['errcode']}",
                "error" => $data["errcode"]
            ]);
        }else{
                echo $this->view->render("error", [
                    "title" => "Erro {$data['errcode']}",
                    "error" => $data["errcode"]
                ]);
        }
    }

    public function login()
    {
        echo $this->view->render("/login", [
            "title" => "Console Login"]);
    }
    public function loga($data)
    {
        echo $this->view->render("/fragments/loga", [
            "title" => "Home |Gbs",
            "data" => $data
        ]);
    }
    public function logout()
    {
        echo $this->view->render("/fragments/logout", [
            "title" => "Home |Gbs"
        ]);
    }
    public function gerapdf()
    {
        echo $this->view->render("fragments/geradores/gerapdf", []);
    }
}
