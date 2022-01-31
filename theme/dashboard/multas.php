<?php $this->layout("/dashboard/_theme");
messageDash();
?>

<div class="container-fluid p-0">

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Gestor de </strong> Multas </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <label for="car" class="text-control mb-3">Cadastrar Multa</label>

                        <div class="col-9">
                            <input class="form-control " type="text" id="car" name="car" placeholder="Busque pelo renavam do caminhão ou reboque" autocomplete="off" />
                        </div>
                        <div class="col-3">
                            <button type="button" data-buscacar="<?= url("console/multas/searchcar") ?>" data-car="" class="btn btn-primary ">Buscar veículo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-xxl-6 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Pagas</h5>
                                <h3 class="mt-1 mb-3"><?= $pagas ?> </h3>
                                <div class="mb-1">
                                    <span class="text-success"><a href="#">Consultar</a> </span>
                                    <span class="text-muted">todas as Faturas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Pendentes</h5>
                                <h3 class="mt-1 mb-3"><?= $pendentes ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted"> Pendencia de pagto</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Multas do dia</h5>
                                <h3 class="mt-1 mb-3"><?= $multasdia ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted">Multas cadastradas hoje</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Multas do Mês</h5>
                                <h3 class="mt-1 mb-3"><?= $multasmes ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted">Multas cadastradas esse mês</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-6 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Atrasadas</h5>
                                <h3 class="mt-1 mb-3"><?= $vencidas ?> </h3>
                                <div class="mb-1">
                                    <span class="text-muted"> Vencidas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Gasto diário</h5>
                                <h3 class="mt-1 mb-3"><?php
                                                        if ($totaldodia) :
                                                            $valortotal = 0;
                                                            foreach ($totaldodia as $total) :
                                                                $valortotal += $total->valor;
                                                            endforeach;
                                                            echo "R$ " . number_format($valortotal, 2, ",", ".");
                                                        else :
                                                            echo "R$ 0,00";
                                                        endif; ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted">Saldo de gastos diários</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Gastos mensais</h5>
                                <h3 class="mt-1 mb-3"><?php
                                                        if ($mensais) :
                                                            $valortotal = 0;
                                                            foreach ($mensais as $total) :
                                                                $valortotal += $total->valor;
                                                            endforeach;
                                                            echo "R$ " . number_format($valortotal, 2, ",", ".");
                                                        else :
                                                            echo "R$ 0,00";
                                                        endif; ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted">Saldo de gastos do mês</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Motorista mais pontuado</h5>
                                <h3 class="mt-1 mb-3"> </h3>
                                <div class="mb-1">
                                    <span class="text-muted">Relação de pontuação mensal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabela de Multas cadastradas</h4>
            </div>
            <div class="card-body">
                <table id="multastable" class="table table-striped text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>Veículo</th>
                            <th>Modelo</th>
                            <th>Renavam</th>
                            <th>Validade Renavam</th>
                            <th>Motorista</th>
                            <th>Vencimento Fatura</th>
                            <th>Valor documento</th>
                            <th>Data de pagamento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($multas) :
                            /*@var Clients*/
                            foreach ($multas as $multa) :

                                $dt_atual        = date("Y-m-d"); // data atual
                                $timestamp_dt_atual     = strtotime($dt_atual);
                                $dt_expira = strtotime($multa->data_vencto);

                                $data_vencto = new DateTime($multa->data_vencto);
                                $data_pagto = new DateTime($multa->data_pagto);

                                if ($multa->caminhao()) {
                                    $cam_validaderenavam = new DateTime($multa->caminhao()[0]->validade_renavam);
                                }
                                if ($multa->reboque()) {
                                    $reb_validaderenavam = new DateTime($multa->reboque()[0]->validade_renavam);
                                }
                        ?>
                                <tr>
                                    <td><?php if ($multa->caminhao()) : echo "Caminhão";
                                        elseif ($multa->reboque()) : echo "Reboque";
                                        endif; ?></td>
                                    <td><?php if ($multa->caminhao()) : echo  $multa->caminhao()[0]->modelo;
                                        elseif ($multa->reboque()) : echo "Reboque";
                                        endif; ?></td>
                                    <td><?php if ($multa->caminhao()) : echo  $multa->caminhao()[0]->renavam_caminhao;
                                        elseif ($multa->reboque()) : echo $multa->reboque()[0]->renavam_reboque;
                                        endif; ?></td>
                                    <td><?php if ($multa->caminhao()) : echo  $cam_validaderenavam->format("d/m/Y");
                                        elseif ($multa->reboque()) : echo  $reb_validaderenavam->format("d/m/Y");
                                        endif; ?></td>
                                    <td><?= $multa->motorista()->nome . " " .  $multa->motorista()->sobrenome ?></td>
                                    <td><?php if (!isset($multa->data_pagto) and $timestamp_dt_atual > $dt_expira) : echo "<a class='badge btn-danger'>Vencida em " . $data_vencto->format("d/m/Y") . "</a>";
                                        else : echo $data_vencto->format("d/m/Y");
                                        endif; ?></td>
                                    <td><?= "R$ " . number_format($multa->valor, 2, ",", ".") ?></td>
                                    <td><?php if ($multa->data_pagto) : echo "<a class='badge btn-success'>Pago em " . $data_pagto->format("d/m/Y") . "</a>";
                                        else : echo "<a class='badge btn-danger'>Não paga</a>";
                                        endif; ?></td>

                                    <td class="table-action">
                                        <button class="btn btn-outline-dark fas fa-sync-alt" style="border: none;" data-id="<?= $multa->id ?>" data-editmulta="<?= url("console/multas/edit") ?>"></button>
                                        <button data-exclude="<?= url("console/multas/destroy") ?>" class=" btn btn-outline-danger fa fa-trash" data-id="<?= $multa->id ?>" aria-hidden="true" style=" border: none;"></button>
                                    </td>
                                </tr>
                            <?php
                            endforeach;

                        else :
                            ?>
                            <tr>
                                <th>
                                    <h4>Não existem multas cadastradas</h4>
                                </th>
                            </tr>
                        <?php
                        endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Modal pdf -->

<div class="modal fade bd-example-modal-lg" id="modalPdf" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visualizar PDF</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="pdfViewer" class="modal-body m-3">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal pdf-->
<!-- Modal nova multa caminhao -->
<div class="modal fade bd-example-modal-lg" id="modalCaminhao" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= url("console/multas/nova") ?>" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar nova multa no sistema</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                                <li id="licam" class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab4">Informações do caminhão </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="placa_caminhao">Placa do caminhão</label>
                                            <input type="text" name="placa_caminhao" class="form-control" id="placa_caminhao" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="modelo_caminhao">Modelo</label>
                                            <input type="text" name="modelo_caminhao" class="form-control" id="modelo_caminhao" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="renavam_caminhao">Renavam do caminhão</label>
                                            <input type="text" name="renavam_caminhao" class="form-control" id="renavam_caminhao" disabled>
                                            <input type="hidden" name="id_caminhao" class="form-control" id="id_caminhao">
                                            <input type="hidden" name="id_operador" class="form-control" id="id_operador" value="<?= $_SESSION["user_id"] ?>">
                                            <input type="hidden" name="namedoc" id="namedoc">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="validade_rena_cam">Validade Renavam</label>
                                            <input type="text" name="validade_rena_cam" class="form-control" id="validade_rena_cam" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-3">
                                            <label class="form-label" for="driver_id">Selecione o Motorista</label>
                                            <input type="search" name="driver_id" class="form-control" id="driver_id" list="driver_select1" onchange="fetchDriverInfo1(this.value)">
                                            <datalist id="driver_select1">
                                                <?php foreach ($drivers as $d) : ?>
                                                    <option value="<?= $d->id ?>"><?= $d->nome . " " . $d->sobrenome ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_name">Nome e Sobrenome</label>
                                            <input type="text" name="driver_name" class="form-control" id="driver_name" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_cnh">CNH</label>
                                            <input type="text" name="driver_cnh" class="form-control" id="driver_cnh" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_validadecnh">Validade CNH</label>
                                            <input type="text" name="driver_validadecnh" class="form-control" id="driver_validadecnh" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="docmulta">Upload do Documento</label>
                                            <input type="file" name="docmulta" class="form-control" id="docmulta" required>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="numero_doc">Numero Doc <small>(auto de infração)</small></label>
                                            <input type="text" name="numero_doc" class="form-control" id="numero_doc" autocomplete="off">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="data_vencto">Data de vencto da multa</label>
                                            <input type="date" name="data_vencto" class="form-control" id="data_vencto" autocomplete="off">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="data_pagto">Data de pagto da multa</label>
                                            <input type="date" name="data_pagto" id="data_pagto" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="valor_multa">Valor Documento</label>
                                            <input type="text" name="valor_multa" id="valor_multa" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="col-9">
                                            <label class="form-label" for="obs_multa">Observações</label>
                                            <textarea name="obs_multa" id="obs_multa" class="form-control" autocomplete="off" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar Multa</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal nova multa Caminhao -->

<!-- Modal nova Multa reboque -->
<div class="modal fade bd-example-modal-lg" id="modalReboque" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= url("console/multas/nova") ?>" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar nova multa no sistema</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                                <li id="lireb" class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab5">Informações do reboque</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab5" role="tabpanel">
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label class="form-label" for="placa_reboque">Placa do reboque</label>
                                            <input type="text" name="placa_reboque" class="form-control" id="placa_reboque" disabled>
                                        </div>

                                        <div class="col-4">
                                            <label class="form-label" for="renavam_reboque">Renavam do reboque</label>
                                            <input type="text" name="renavam_reboque" class="form-control" id="renavam_reboque" disabled>
                                            <input type="hidden" name="id_reboque" class="form-control" id="id_reboque">
                                            <input type="hidden" name="id_operador" class="form-control" id="id_operador" value="<?= $_SESSION["user_id"] ?>">
                                            <input type="hidden" name="namedocc" id="namedocc">
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="validade_rena_reb">Validade Renavam</label>
                                            <input type="text" name="validade_rena_reb" class="form-control" id="validade_rena_reb" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-3">
                                            <label class="form-label" for="driver_id">Selecione o Motorista</label>
                                            <input type="search" name="driver_id" class="form-control" id="driver_id" list="driver_select2" onchange="fetchDriverInfo2(this.value)">
                                            <datalist id="driver_select2">
                                                <?php foreach ($drivers as $d) : ?>
                                                    <option value="<?= $d->id ?>"><?= $d->nome . " " . $d->sobrenome ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_name1">Nome e Sobrenome</label>
                                            <input type="text" name="driver_name1" class="form-control" id="driver_name1" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_cnh1">CNH</label>
                                            <input type="text" name="driver_cnh1" class="form-control" id="driver_cnh1" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_validadecnh1">Validade CNH</label>
                                            <input type="text" name="driver_validadecnh1" class="form-control" id="driver_validadecnh1" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="docmulta">Upload de documentos</label>
                                            <input type="file" name="docmultaa" class="form-control" id="docmultaa" required>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="numero_doc">Numero Doc <small>(auto de infração)</small></label>
                                            <input type="text" name="numero_doc" class="form-control" id="numero_doc" autocomplete="off">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="email">Data de vencto da multa</label>
                                            <input type="date" name="data_vencto" class="form-control" id="data_vencto" autocomplete="off">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="data_pagto">Data de pagto da multa</label>
                                            <input type="date" name="data_pagto" id="data_pagto" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="valor_multa">Valor Documento</label>
                                            <input type="text" name="valor_multa" id="valor_multa" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="col-9">
                                            <label class="form-label" for="obs_multa">Observações</label>
                                            <textarea name="obs_multa" id="obs_multa" class="form-control" autocomplete="off" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar Multa</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal nova Multa reboque -->


<!-- Modal edit multa -->
<div class="modal fade bd-example-modal-lg" id="modalEdit" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= url("console/multas/upgrade") ?>" enctype="multipart/form-data" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar multa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                                <li id="licam" class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab6">Informações do Veículo</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="placa_veh">Placa do Veículo</label>
                                            <input type="text" name="placa_veh" class="form-control" id="placa_veh" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="modelo_veh">Modelo</label>
                                            <input type="text" name="modelo_veh" class="form-control" id="modelo_veh" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="renavam_veh">Renavam</label>
                                            <input type="text" name="renavam_veh" class="form-control" id="renavam_veh" disabled>
                                            <input type="hidden" name="id_multa" class="form-control" id="id_multa">
                                            <input type="hidden" name="id_operador" class="form-control" id="id_operador" value="<?= $_SESSION["user_id"] ?>">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="validade_rena_veh">Validade Renavam</label>
                                            <input type="text" name="validade_rena_veh" class="form-control" id="validade_rena_veh" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-3">
                                            <label class="form-label" for="driver_veh">Trocar Motorista</label>
                                            <input type="search" name="driver_veh" class="form-control" id="driver_veh" list="driver_select2" onchange="fetchDriverInfo3(this.value)">
                                            <datalist id="driver_select2">
                                                <?php foreach ($drivers as $d) : ?>
                                                    <option value="<?= $d->id ?>"><?= $d->nome . " " . $d->sobrenome ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_name2">Nome e Sobrenome</label>
                                            <input type="text" name="driver_name2" class="form-control" id="driver_name2" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_cnh2">CNH</label>
                                            <input type="text" name="driver_cnh2" class="form-control" id="driver_cnh2" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="driver_validadecnh2">Validade CNH</label>
                                            <input type="text" name="driver_validadecnh2" class="form-control" id="driver_validadecnh2" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="docmulta">Visualizar Documento</label>
                                            <button class="btn btn-primary" data-viewpdf="<?= url("console/multas/viewpdf") ?>" data-id="">Vizualizar doc</button>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="numero_doc1">Numero Doc <small>(auto de infração)</small></label>
                                            <input type="text" name="numero_doc1" class="form-control" id="numero_doc1" autocomplete="off">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="data_vencto1">Data de vencto da multa</label>
                                            <input type="date" name="data_vencto1" class="form-control" id="data_vencto1" autocomplete="off">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label" for="data_pagto1">Data de pagto da multa</label>
                                            <input type="date" name="data_pagto1" id="data_pagto1" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="form-label" for="valor_multa1">Valor Documento</label>
                                            <input type="text" name="valor_multa1" id="valor_multa1" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="col-9">
                                            <label class="form-label" for="obs_multa1">Observações</label>
                                            <textarea name="obs_multa" id="obs_multa1" class="form-control" autocomplete="off" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar Multa</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal edit multa  -->

<script>
    $(document).ready(function() {
        $.ajaxSetup({ cache: false });
        $('#multastable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ]
        });
    });
    $('body').on("click", ".btn-close", function(e){
        var modal =$(this).closest(".modal");
        modal.modal('hide');

    });
    $('body').on("click", "[data-dismiss]",function(e){
        var modal =$(this).closest(".modal");
        modal.modal('hide');

    });
    $('body').on("click", "[data-exclude]", function(e) {
        e.preventDefault();
        var data = $(this).data();
        var $tr = $(this).closest("tr");

        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Excluir multa!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(data.exclude, data, function(data) {
                    console.log(data);
                    Swal.fire({
                        icon: data.icon,
                        title: data.title,
                        text: data.msg
                    });
                    if (data.success) {
                        $tr.fadeOut();
                    }
                }, "json").fail(function() {
                    alert("Erro ao processar requisição");
                });
            }
        });

    });

    $('body').on("click", "[data-editmulta]", function(e) {
        e.preventDefault();
        var data = $(this).data();

        $.post(data.editmulta, data, function(data) {
            $("#modalEdit").modal('show');
            $("#id_multa").val(data.id);
            $("#placa_veh").val(data.placa);
            $("#modelo_veh").val(data.modelo);
            $("#renavam_veh").val(data.renavam);
            $("#validade_rena_veh").val(data.validaderena);
            $("#driver_name2").val(data.drivername);
            $("#driver_cnh2").val(data.drivercnh);
            $("#driver_validadecnh2").val(data.validadecnh);
            $("#numero_doc1").val(data.numerodoc);
            $("#data_vencto1").val(data.vencto);
            $("#data_pagto1").val(data.pagto);
            $("#valor_multa1").val(data.valordoc);
            $("#obs_multa1").val(data.obsmulta);

        }, "json").fail(function() {
            alert("Erro ao processar requisição");
        });
    });

    function fetchDriverInfo1(id) {

        $('#driver_name').val("...");
        $('#driver_cnh').val("...");
        $("#driver_validadecnh").val("...");

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?= url('console/multas/fetchdriverinfo') ?>',
            data: {
                motorista_id: id
            },
            success: function(data) {
                $('#driver_name').val(data.drivername);
                $('#driver_cnh').val(data.cnh);
                $("#driver_validadecnh").val(data.validadecnh);
            }

        })

    }

    function fetchDriverInfo2(id) {

        $('#driver_name1').val("...");
        $('#driver_cnh1').val("...");
        $("#driver_validadecnh1").val("...");

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?= url('console/multas/fetchdriverinfo') ?>',
            data: {
                motorista_id: id
            },
            success: function(data) {
                $('#driver_name1').val(data.drivername);
                $('#driver_cnh1').val(data.cnh);
                $("#driver_validadecnh1").val(data.validadecnh);
            }

        })

    }

    function fetchDriverInfo3(id) {

        $('#driver_name2').val("");
        $('#driver_cnh2').val("");
        $("#driver_validadecnh2").val("");

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?= url('console/multas/fetchdriverinfo') ?>',
            data: {
                motorista_id: id
            },
            success: function(data) {
                $('#driver_name2').val(data.drivername);
                $('#driver_cnh2').val(data.cnh);
                $("#driver_validadecnh2").val(data.validadecnh);
            }

        })

    }
    $('body').on("click", "[data-viewpdf]", function(e) {
        e.preventDefault();
        var data = $(this).data();
        var pdf = $('#id_multa').val();
        data.id += (pdf);

        $.post(data.viewpdf, data, function(data) {
            console.log(data);

            $("#modalEdit").modal('hide');
            $("#modalPdf").modal("show");
            $('#pdfViewer').html(data.pdf);

        }, "json").fail(function(data) {
            console.log(data);

            alert("Erro ao processar requisição");
        });


    });
    $('body').on("click", "[data-buscacar]", function(e) {
        e.preventDefault();
        var data = $(this).data();
        var car = $('#car').val();
        data.car += (car);

        if (car == '') {

            Swal.fire({
                title: 'OOPS!',
                text: "Digite o numero do renavam!",
                icon: 'error',
            });
        } else {

            $.post(data.buscacar, data, function(data) {
                console.log(data);

                if (data.caminhao === true) {

                    $("#modalCaminhao").modal("show");
                    $('#car').val("");
                    $("#id_caminhao").val(data.id);
                    $("#renavam_caminhao").val(data.renavam);
                    $('#namedoc').val(data.renavamm);
                    $("#placa_caminhao").val(data.placa);
                    $("#modelo_caminhao").val(data.modelo);
                    $("#validade_rena_cam").val(data.validaderena);

                } else if (data.reboque === true) {

                    $("#modalReboque").modal("show");
                    $('#car').val("");
                    $("#id_reboque").val(data.id);
                    $("#renavam_reboque").val(data.renavam);
                    $('#namedocc').val(data.renavamm);
                    $("#placa_reboque").val(data.placa);
                    $("#validade_rena_reb").val(data.validaderena);
                } else {

                    Swal.fire({
                        icon: data.icon,
                        title: data.title,
                        text: data.text,
                    });
                    $('#car').val("");

                }

            }, "json").fail(function(data) {
                console.log(data);

                alert("Erro ao processar requisição");
            });
        }


    });
</script>