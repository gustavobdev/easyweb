<?php
$router = new \CoffeeCode\Router\Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("app/login");
}
emServico();
PreenchePerfil();
$this->layout("/app/_theme"); ?>

<!-- Meus Fretes -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Minhas Candidaturas</h2>
    </div>
    <div class="transactions">
        <?php
        if ($candidaturas) :
            foreach ($candidaturas as $candidatura) :
                if ($candidatura->motorista == $_SESSION["driver_id"]) :

        ?>
                    <!-- item -->
                    <a href="<?= url("app/infofrete/{$candidatura->id}") ?>" class="item">
                        <div class="detail">
                            <div>
                                <strong><?= $candidatura->origem_city()[0]->nome . "/" . $candidatura->uf_origem()[0]->uf . " x " . $candidatura->destino_city()[0]->nome . "/" . $candidatura->destin_uf()[0]->uf ?></strong>
                                <p>Descrição: <?= $candidatura->fretes()[0]->dimensao . " " . $candidatura->fretes()[0]->tipo ?></p>
                                <p><?= $candidatura->fretes()[0]->obs_frete_motorista ?>
                                <p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-success"> R$ <?= $candidatura->fretes()[0]->frete_motorista ?></div>
                        </div>
                    </a>
                    <!-- * item -->
        <?php
                endif;
            endforeach;
        else :
            echo '<a class="item"><div class="detail"><strong>Você não se candidatou à nenhum frete.</strong></div></a>';
        endif;
        ?>

    </div>
</div>
<!-- * Meus Fretes  -->