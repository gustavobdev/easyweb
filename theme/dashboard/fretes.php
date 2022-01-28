<?php $this->layout("/dashboard/_theme");
messageDash();
?>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Pendentes de CT-E</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" style="width:100%" id="pendentecte">
                    <thead>
                        <tr>
                            <th>Id / CTE</th>
                            <th>Criação</th>
                            <th>Origem / Destino</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Motorista</th>
                            <th>Faturamento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($fretes) :
                            /*@var Clients*/
                            foreach ($fretes as $frete) :
                                if ($frete->doc_viagem_cte == null) :
                        ?>
                                    <tr>
                                        <td><?= $frete->id . "/"; ?> <?= $frete->doc_viagem_cte ? $frete->doc_viagem_cte : "Vazio" ?></td>
                                        <td><?= $frete->created_at ?></td>
                                        <td>
                                            <?= $frete->origem_city() ?  $frete->origem_city()[0]->nome . " / " : "Vazio / "; ?>
                                            <?= $frete->uf_origem() ? $frete->uf_origem()[0]->uf . " => " :  "Vazio => "; ?>
                                            <?= $frete->destino_city() ? $frete->destino_city()[0]->nome . " / " : "Vazio / "; ?>
                                            <?= $frete->destin_uf() ? $frete->destin_uf()[0]->uf : "Vazio"; ?></td>
                                        <td>
                                            <?= $frete->clientes() ? $frete->clientes()[0]->razao_social : "Sem cliente" ?> <a href="<?= url("console/clientes/") ?>">
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <?= $frete->status_fretes()[0]->status_desc ?>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <?= $frete->motoristas() ? $frete->motoristas()[0]->nome . " " . $frete->motoristas()[0]->sobrenome : "Sem motorista" ?>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <a><?= $frete->n_fatura_cliente ? 'Faturado' : 'Não faturado' ?></a>
                                        </td>
                                        <td class="table-action">
                                            <a href="<?= url("console/fretes/{$frete->id}") ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                            <?php if ($frete->pdf()) : ?>
                                                <a href="<?= URL_BASE . $frete->pdf()[0]->caminho ?>" download="<?= $frete->pdf()[0]->doc_viagem_cte ?>"><i class="align-middle" data-feather="download"></i></a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;

                        else :
                            ?>
                            <h4>Não existem fretes cadastrados</h4>
                        <?php
                        endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Com registro de CT-E</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" style="width:100%" id="comcte">
                        <thead>
                            <tr>
                                <th>Id / CTE</th>
                                <th>Criação</th>
                                <th>Origem / Destino</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Motorista</th>
                                <th>Faturamento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if ($fretes) :
                                /*@var Clients*/
                                foreach ($fretes as $frete) :
                                    if ($frete->doc_viagem_cte) :
                            ?>
                                        <tr>
                                            <td><?= $frete->id . "/"; ?> <?= $frete->doc_viagem_cte ? $frete->doc_viagem_cte : "Vazio" ?></td>
                                            <td><?= $frete->created_at ?></td>
                                            <td>
                                                <?= $frete->origem_city() ?  $frete->origem_city()[0]->nome . " / " : "Vazio / "; ?>
                                                <?= $frete->uf_origem() ? $frete->uf_origem()[0]->uf . " => " :  "Vazio => "; ?>
                                                <?= $frete->destino_city() ? $frete->destino_city()[0]->nome . " / " : "Vazio / "; ?>
                                                <?= $frete->destin_uf() ? $frete->destin_uf()[0]->uf : "Vazio"; ?></td>
                                            <td>
                                                <?= $frete->clientes() ? $frete->clientes()[0]->razao_social : "Sem cliente" ?> <a href="<?= url("console/clientes/") ?>">
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <?= $frete->status_fretes()[0]->status_desc ?>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <?= $frete->motoristas() ? $frete->motoristas()[0]->nome . " " . $frete->motoristas()[0]->sobrenome : "Sem motorista" ?>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <a><?= $frete->n_fatura_cliente ? 'Faturado' : 'Não faturado' ?></a>
                                            </td>
                                            <td class="table-action">
                                                <a href="<?= url("console/fretes/{$frete->id}") ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                                <?php if ($frete->pdf()) : ?>
                                                    <a href="<?= URL_BASE . $frete->pdf()[0]->caminho ?>" download="<?= $frete->pdf()[0]->doc_viagem_cte ?>"><i class="align-middle" data-feather="download"></i></a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;

                            else :
                                ?>
                                <h4>Não existem fretes cadastrados</h4>
                            <?php
                            endif; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Fretes agendados</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" style="width:100%" id="comcte">
                        <thead>
                            <tr>
                                <th>Id / CTE</th>
                                <th>Criação</th>
                                <th>Origem / Destino</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Motorista</th>
                                <th>Faturamento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if ($fretes) :
                                /*@var Clients*/
                                foreach ($fretes as $frete) :
                                    if ($frete->status_frete === "9") :
                            ?>
                                        <tr>
                                            <td><?= $frete->id . "/"; ?> <?= $frete->doc_viagem_cte ? $frete->doc_viagem_cte : "Vazio" ?></td>
                                            <td><?= $frete->created_at ?></td>
                                            <td>
                                                <?= $frete->origem_city() ?  $frete->origem_city()[0]->nome . " / " : "Vazio / "; ?>
                                                <?= $frete->uf_origem() ? $frete->uf_origem()[0]->uf . " => " :  "Vazio => "; ?>
                                                <?= $frete->destino_city() ? $frete->destino_city()[0]->nome . " / " : "Vazio / "; ?>
                                                <?= $frete->destin_uf() ? $frete->destin_uf()[0]->uf : "Vazio"; ?></td>
                                            <td>
                                                <?= $frete->clientes() ? $frete->clientes()[0]->razao_social : "Sem cliente" ?> <a href="<?= url("console/clientes/") ?>">
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <?= $frete->status_fretes()[0]->status_desc ?>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <?= $frete->motoristas() ? $frete->motoristas()[0]->nome . " " . $frete->motoristas()[0]->sobrenome : "Sem motorista" ?>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <a><?= $frete->n_fatura_cliente ? 'Faturado' : 'Não faturado' ?></a>
                                            </td>
                                            <td class="table-action">
                                                <a href="<?= url("console/fretes/{$frete->id}") ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                                <?php if ($frete->pdf()) : ?>
                                                    <a href="<?= URL_BASE . $frete->pdf()[0]->caminho ?>" download="<?= $frete->pdf()[0]->doc_viagem_cte ?>"><i class="align-middle" data-feather="download"></i></a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;

                            else :
                                ?>
                                <h4>Não existem fretes cadastrados</h4>
                            <?php
                            endif; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php $this->push("scripts") ?>
    <script>
        $(document).ready(function() {
            $('#pendentecte').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todos"]
                ]
            });
            $('#comcte').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Todos"]
                ]
            });
        });
    </script>
    <?php $this->end() ?>