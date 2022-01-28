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
        <h2 class="title">Fretes publicados</h2>
    </div>
    <div class="transactions">
        <?php
        if ($fretes) :
            foreach ($fretes as $frete) :
        ?>
                <!-- item -->
                <a href="<?= url("app/infofrete/{$frete->id}") ?>" class="item">
                    <div class="detail">
                        <div>
                            <strong><?= $frete->origem_city()[0]->nome . "/" . $frete->uf_origem()[0]->uf . " x " . $frete->destino_city()[0]->nome . "/" . $frete->destin_uf()[0]->uf ?></strong>
                            <p>Descrição: <?= $frete->dimensao . " " . $frete->tipo ?></p>
                            <p><?= $frete->obs_frete_motorista ?>
                            <p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-success"> R$ <?= $frete->frete_motorista ?></div>
                    </div>
                </a>
                <!-- * item -->
        <?php
            endforeach;
        else :
            echo '<a class="item"><div class="detail"><strong>Sem fretes publicados.</strong></div></a>';
        endif;
        ?>

    </div>
</div>
<!-- * Meus Fretes  -->