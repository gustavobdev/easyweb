<?php $this->layout("/dashboard/_theme");?>

<div class="row">
    <div class="col-xl-12 col-xxl-12 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Pagas</h5>
                            <h3 class="mt-1 mb-3 text-success"><?= "R$ ".number_format($pagas,2,",",".") ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Pendentes</h5>
                            <h3 class="mt-1 mb-3 "><?= "R$ ".number_format($pendentes,2,",",".") ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Em Atraso</h5>
                            <h3 class="mt-1 mb-3 text-danger"><?= "R$ ".number_format($atrasadas,2,",",".") ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Canceladas</h5>
                            <h3 class="mt-1 mb-3 text-secondary"><?= "R$ ".number_format($canceladas,2,",",".") ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Financeiro</h5>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10%">Fatura</th>
                    <th style="width: 30%">Cliente</th>
                    <th class="d-none d-md-table-cell" style="width:10%">Status</th>
                    <th class="width: 30%" style="width:15%">Valor</th>
                    <th class="" style="width:15%">Vencimento</th>
                    <th class="" style="width:15%">Data Pagto.</th>
                    <th style="width: 10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                      <?php if($builds):
                        foreach ($builds as $build):
                            ?>
                        <tr>
                            <td><?= $build->id ?></td>
                            <td>
                                <?= $build->clients()->razao ?>
                            </td>
                            <td><?= $build->status_fatura()->desc_status?></td>
                            <td><?= "R$ ".number_format($build->valor,2,",",".") ?></td>
                            <td>
                                <?php
                                    $date = new DateTime($build->vencimento);
                                    echo $date->format("d/m/Y")
                                ?>
                            </td>
                            <td><?= $build->data_pgto?></td>
                            <td class="table-action">
                                <a href="#"><i class="align-middle" data-feather="eye"></i></a>
                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                    else:
                        ?>
                        <h4>Não existem faturas cadastradas</h4>
                    <?php
                    endif; ?>


                </tbody>
            </table>
        </div>
    </div>
