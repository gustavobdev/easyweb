<?php
$router = new \CoffeeCode\Router\Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}
messagePerfil();

if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("/app/login");
};
$this->layout("/app/_theme");
?>

<!-- Meus Fretes -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Meus Caminhões</h2>
    </div>
    <div class="transactions">
        <!-- item -->
        <?php
        if ($caminhoes) : ?>
            <a class="link small">Clique no caminhão para editar</a><br>
            <?php foreach ($caminhoes as $caminhao) :
            ?>
                <a class="item">
                    <div class="detail">
                        <div>
                            <strong>Modelo: <?= $caminhao->caminhao()[0]->modelo ?></strong>
                            <p>PLACA: <?= $caminhao->caminhao()[0]->placa_caminhao ?></p>
                            <p>COR: <?= $caminhao->caminhao()[0]->cor ?></p>
                            <p>TIPO: <?= $caminhao->caminhao()[0]->tipo_caminhao == "1" ? "Reboque" : "Baú"; ?></p>
                        </div>
                    </div>

                    <?php if ($caminhao->caminhao()[0]->id === $car_emuso) : ?>
                        <div class="right">
                            <div class="price text-success"> Em Uso </div>
                        </div>
                    <?php else : ?>
                        <div class="right">
                            <form method="POST" action="<?= url("app/selectcar") ?>">
                                <input type="text" style="display: none;" value="<?= $caminhao->caminhao()[0]->id ?>" name="car_id" id="cr_id" />
                                <button type="submit" class="badge badge-primary" style="border: none;">Selecionar</button>
                            </form>
                        </div>

                    <?php endif; ?>
                </a>
        <?php
            endforeach;
        else :
            echo '<a href="" class="item"><div class="detail"><strong>Sem caminhões cadastrados.</strong></div></a>';
        endif;
        ?>
        <!-- * item -->
    </div>
</div>
<div class="section mt-4">
    <a data-toggle="modal" data-target=" #caminhao" class="btn btn-primary mr-1 mb-1">Adicionar Caminhão</a>
</div>

<!--ADICIONAR REBOQUE -->
<div class="modal fade dialogbox" id="caminhao" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Caminhão</h5>
            </div>

            <form method="POST" action="<?= url("app/editcar/save") ?>">
                <div class="modal-body text-left mb-5">

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="placa">Placa</label>
                                <input type="text" class="form-control" id="placa" name="placa" placeholder="Digite a placa do veículo">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="renavam">Renavam</label>
                                <input type="text" name="renavam" id="renavam" placeholder="Digite o renavam" class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Modelo</label>
                                <input type="text" name="modelo" id="modelo" placeholder="Digite o modelo do veículo" class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Cor</label>
                                <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                                <input type="text" name="cor" id="cor" placeholder="Cor predominante do veículo" class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Tipo</label>
                                <select class="form-control custom-select" name="tipo" id="tipo">
                                    <option value="Reboque">Reboque</option>
                                    <option value="Baú">Baú</option>
                                </select>
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
<?php $this->push("scripts");

$this->end();

?>
