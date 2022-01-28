    <?php
    $router = new \CoffeeCode\Router\Router(URL_BASE);
if(!isset($_SESSION)){
    session_start();

}
    if (isset($_SESSION['driver_first_name']) == false){
        $router->redirect("app/login");
    }

;?>

<?php $url = URL_BASE ?>
<?php $this->layout("/app/_theme");?>

    <div class="section mt-2 mb-2">

        <div class="listed-detail mt-3">
            <div class="icon-wrapper">
                <div class="iconbox">
                    <ion-icon name="cube"></ion-icon>
                </div>
            </div>
            <h3 class="text-center mt-2">REF: <?= $frete[0]->id."/".$frete[0]->doc_viagem_cte  ?> </h3>
        </div>

        <ul class="listview flush transparent simple-listview no-space mt-3">
            <li>
                <strong>Status</strong>
              <span class="text-success"><?= $frete[0]->status_fretes()[0]->status_desc  ?></span>
            </li>
            <li>
                <strong>Tipo de carga:</strong>
                <span><?= $frete[0]->mercadoria_produto?> </span>
            </li>
            <li>
                <strong>Trajeto</strong>
                <span> De: <strong><?= $frete[0]->origem_city()[0]->nome .' - '. $frete[0]->uf_origem()[0]->uf ?> </strong> Até: <strong><?= $frete[0]->destino_city()[0]->nome. ' - ' . $frete[0]->destin_uf()[0]->uf?></strong> </span>
            </li>
            <li>
                <strong>IMO</strong>
                <span><?= $frete[0]->imo == "1" ? "Sim" : "Não" ?></span>
            </li>
            <li>
                <strong>Tipo</strong>
                <span><?= $frete[0]->dimensao." ".$frete[0]->tipo?></span>
            </li>
            <li>
                <strong>Criado em:</strong>
                <span><?php
                        $dataC = new DateTime($frete[0]->created_at);
                        echo $dataC->format("d/m/Y")." às ".$dataC->format("h:i")
                    ?> </span>
            </li>
            <li>
                <strong>Valor</strong>
                <h3 class="m-0">R$ <?= $frete[0]->frete_motorista?></h3>
            </li>
            <li>
                <strong>Observações</strong>
                <span class="m-0"><?= $frete[0]->obs_frete_motorista?></span>
            </li>
            <?php if(!isset($frete[0]->motorista)): ?>
            <li>
                <input href="#"  data-toggle="modal" data-target="#DialogIconedSuccess" class="w-100 wbx-font-size btn btn-primary " type="button" value="Canditar-se">
            </li>
            <?php endif; ?>
        </ul>


    </div>


    <!-- DialogIconedSuccess -->
    <div class="modal fade dialogbox" id="DialogIconedSuccess" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-success">
                    <ion-icon name="checkmark-circle"></ion-icon>
                </div>
                <form method="post" action="<?=$url?>app/geraCandidatura">
                    <input type="text" style="display: none"  name="id_frete" value="<?= $frete[0]->id ?>">
                    <input type="text" style="display: none"  name="id_motorista" value="<?= $_SESSION['driver_id'] ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Solicitação concluída</h5>
                    </div>
                    <div class="modal-body">
                        Aguarde até que um operador aceite sua candidatura.
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button type="submit" class="btn" >Voltar para meus fretes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- * DialogIconedSuccess -->