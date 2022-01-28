<?php
$router = new \CoffeeCode\Router\Router(URL_BASE);
session_start();

if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("/app/login");
};
$this->layout("/app/_theme");
messagePerfil();
?>


<div class="section mt-2 mb-2">
    <div class="section-title mt-1">Editar informações bancárias</div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?= url("app/editbank/save") ?>">
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Agência</label>
                        <input type="search" class="form-control" id="banco" name="banco" <?= $_SESSION["driver_banco"] ? "value='{$_SESSION['driver_banco']}'" : 'placeholder="Digite o código da agencia"'; ?> list="bancos">
                        <datalist id="bancos">
                            <?php
                            foreach ($banks as $bank) :
                            ?>
                                <option value="<?= $bank->banco ?>"></option>
                            <?php
                            endforeach;
                            ?>
                        </datalist>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Conta</label>
                        <input type="text" name="conta" id="conta" <?= $_SESSION["driver_conta"] ? "value='{$_SESSION['driver_conta']}'" : 'placeholder="Digite o número da conta"'; ?> class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Titular da conta</label>
                        <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                        <input type="text" name="titular" id="titular" <?= $_SESSION["driver_titular"] ? "value='{$_SESSION['driver_titular']}'" : 'placeholder="Digite o nome do titular da conta"'; ?> class="form-control">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">CPF do titular da conta</label>
                        <input type="text" name="cpf_conta" id="cpf_conta" <?= $_SESSION["driver_cpf_conta"] ?  "value='{$_SESSION['driver_cpf_conta']}'" : 'placeholder="CPF do titular da conta"'; ?> class="form-control">
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