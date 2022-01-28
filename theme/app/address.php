<?php
$router = new \CoffeeCode\Router\Router(URL_BASE);
if(!isset($_SESSION)){
session_start();
}
if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("/app/login");
}
messagePerfil();

$this->layout("/app/_theme"); ?>


<div class="section mt-2 mb-2">
    <div class="section-title mt-1">Editar informações de logradouro</div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?= url("app/editaddress/save") ?>">

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" <?= $_SESSION["driver_rua"] ? "value='{$_SESSION['driver_rua']}'" : 'placeholder="Digite o nome da rua"'; ?>>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Número</label>
                        <input type="text" name="numero" id="numero" <?= $_SESSION["driver_numero"] ? "value='{$_SESSION['driver_numero']}'" : 'placeholder="Digite o número da casa/apto"'; ?> class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Bairro</label>
                        <input type="text" name="bairro" id="bairro" <?= $_SESSION["driver_bairro"] ? "value='{$_SESSION['driver_bairro']}'" : 'placeholder="Digite seu Bairro"'; ?> class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Cidade</label>
                        <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                        <input type="text" name="cidade" id="cidade" <?= $_SESSION["driver_cidade"] ?  "value='{$_SESSION['driver_cidade']}'" : 'placeholder="Cidde Atual"'; ?> class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Estado</label>
                        <input type="text" name="estado" id="estado" <?= $_SESSION["driver_estado"] ? "value='{$_SESSION['driver_estado']}'" : 'placeholder="Digite o Estado"'; ?> class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Salvar Alterações</button>
                </div>
            </form>

        </div>
    </div>
</div>