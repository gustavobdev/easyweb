<?php
$router = new \CoffeeCode\Router\Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("/app/login");
};
$this->layout("/app/_theme");
messagePerfil();
?>

<!-- Meus Fretes -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Meus Reboques</h2>
    </div>
    <div class="transactions">
        <!-- item -->
        <?php
        if ($reboques) : ?>
            <a class="link small">Clique no cavalo para editar</a>
            <?php foreach ($reboques as $reboque) :
            ?>
                <a class="item">
                    <div class="detail">
                        <div>
                            <strong>RENAVAM: <?= $reboque->reboque()[0]->renavam_reboque ?></strong>
                            <p>PLACA: <?= $reboque->reboque()[0]->placa_reboque ?></p>
                            <p>TIPO: <?= $reboque->reboque()[0]->tipo_reboque == "1" ? "Reboque" : "Baú"; ?></p>
                        </div>
                    </div>
                    <?php  if ($reboque->reboque()[0]->id === $reb_emuso) : ?>
                        <div class="right">
                            <div class="price text-success"> Em Uso </div>
                        </div>
                    <?php else : ?>
                        <div class="right">
                            <form method="POST" action="<?= url("app/selectreboque") ?>">
                                <input type="text" style="display: none;" value="<?= $reboque->reboque()[0]->id ?>" name="reb_id" id="reb_id" />
                                <button type="submit" class="badge badge-primary" style="border: none;">Selecionar</button>
                            </form>
                        </div>

                    <?php endif; ?>
                </a>
        <?php
            endforeach;
        else :
            echo '<a href="" class="item"><div class="detail"><strong>Sem reboques cadastrados.</strong></div></a>';
        endif;
        ?>
        <!-- * item -->
    </div>
</div>
<div class="section mt-4">
    <a data-toggle="modal" data-target=" #reboque" class="btn btn-primary mr-1 mb-1">Adicionar Reboque</a>
</div>

<!--ADICIONAR REBOQUE -->
<div class="modal fade dialogbox" id="reboque" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Reboque</h5>
            </div>

            <form method="POST" action="<?= url("app/editreboque/save") ?>">
                <div class="modal-body text-left mb-5">

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="placa">Renavam</label>
                        <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                        <input type="text" class="form-control" name="renavam" id="renavam" placeholder="Digite o renavam do reboque">
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="renavam">Placa</label>
                        <input type="text" id="placa" name="placa" placeholder="Digite a placa" class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a class="btn btn-text-secondary" data-dismiss="modal">FECHAR</a>
                        <button type="submit" class="btn btn-text-primary">ADICIONAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM ADICIONAR REBOQUE-->