<?php
$router = new \CoffeeCode\Router\Router(URL_BASE);
if(!isset($_SESSION)){
    session_start();
    }
if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("/app/login");
};
emServico();
PreenchePerfil();
$this->layout("/app/_theme"); ?>



<!-- Meus Fretes -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Fretes em andamento</h2>
    </div>
    <div class="transactions">
        <?php
        if ($aprovados) :
            foreach ($aprovados as $aprovado) :
                if ($aprovado->motorista == $_SESSION["driver_id"]) :
        ?>
                    <a class="item">
                        <div class="detail">
                            <div>
                                <strong><?= $aprovado->origem_city()[0]->nome ." - ". $aprovado->uf_origem()[0]->uf . " x " . $aprovado->destino_city()[0]->nome . " - " . $aprovado->destin_uf()[0]->uf  ?></strong>
                                
                                <p><?= $aprovado->fretes()[0]->obs_frete_motorista ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-success">R$ <?= $aprovado->fretes()[0]->frete_motorista ?></div>
                        </div>
                    </a>
        <?php
                endif;
            endforeach;
        else :

            echo '<a href="app-transaction-detail.html" class="item"><div class="detail"><strong>Sem fretes aprovados.</strong></div></a>';
        endif;
        ?>

    </div>
</div>
<!-- * Meus Fretes  -->