<?php $this->layout("/dashboard/_theme");?>

<?php /** @var TYPE_NAME $client */?>
<?php $url = URL_BASE ?>

<div class="container-fluid p-0">


    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informações do projeto</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#geral" role="tab">
                        Geral
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#documentos" role="tab">
                        Documentos
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#projetos" role="tab">
                        Projetos
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#campanha" role="tab">
                        Campanhas
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#financeiro" role="tab">
                        Financeiro
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#credenciais" role="tab">
                        Credenciais
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#usuario" role="tab">
                        Usuarios
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                        Solicitações
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <!--Painel de dados da aplicação-->
                <div class="tab-pane fade show active" id="geral" role="tabpanel">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Principais Informações</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Nome do projeto</label>
                                            <input type="text" class="form-control" id="inputUsername" value="<?=$client["0"]->razao?>" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">CNPJ</label>
                                            <input type="text" class="form-control" id="inputUsername" value="<?=$client["0"]->cnpj?>" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Setor</label>
                                            <input type="text" class="form-control" id="inputUsername" value="<?=$client["0"]->setor?>" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Email</label>
                                            <input type="text" class="form-control" id="inputUsername" value="<?=$client["0"]->email?>" >
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Alterar</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!--Painel de dados do Cliente-->
                <div class="tab-pane fade" id="cliente" role="tabpanel">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Dados do cliente</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputFirstName">Razao</label>
                                        <input type="text" class="form-control" id="inputFirstName" value="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputLastName">CNPJ</label>
                                        <input type="text" class="form-control" id="inputLastName" value="" >
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" value="" placeholder="Email">
                                </div>
                                <button type="submit" class="btn btn-primary">Alterar</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!--Painel de Documentos-->
                <div class="tab-pane fade" id="documentos" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Documentos</h5>
                        </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputFirstName">Nome do Arquivo</label>
                                            <input type="text" class="form-control" id="inputFirstName" value="">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputLastName">Arquivo</label>
                                            <input type="file" class="form-control" id="inputLastName" value="" >
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Alterar</button>
                                </form>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:80%;">Arquivo</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Vanessa Tucker</td>
                                            <td class="table-action">
                                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                    </div>
                </div>

                <!--Painel de Projetos-->
                <div class="tab-pane fade" id="projetos" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Projetos</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:20%;">Projetos</th>
                                    <th style="width:20%;">Entregas</th>
                                    <th style="width:20%;">Total de horas</th>
                                    <th style="width:20%;">Descricao</th>
                                    <th style="width:20%;">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($projetos):
                                    foreach ($projetos as $projeto):
                                        ?>
                                        <tr>
                                            <td><?= $projeto->nome ?></td>
                                            <td>
                                                <?php
                                                    if($projeto->entregas()):
                                                ?>
                                                    <?= $projeto->entregas(); ?>
                                                <?php
                                                    else:
                                                        echo "0";
                                                    endif;
                                                ?>
                                            </td>
                                            <td><?= $projeto->horas() ?></td>
                                            <td><?= $projeto->decricao ?></td>
                                            <td class="table-action">
                                                <a href="<?= url("console/edit/{$projeto->nome}/{$projeto->id}") ?>"><i class="align-middle" data-feather="eye"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                    endforeach;
                                else:
                                    echo "esse cliente ainda não possui projetos";
                                endif;
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!--Painel de Campanha-->
                <div class="tab-pane fade" id="campanha" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Campanha</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:5%;">ID</th>
                                    <th style="width:10%;">Fornecedor</th>
                                    <th style="width:15%;">Descrição</th>
                                    <th style="width:5%;">Link</th>
                                    <th style="width:5%;">Data</th>
                                    <th style="width:5%;">Valor</th>
                                    <th style="width:5%;">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($anuncios):
                                    foreach ($anuncios as $anuncio):
                                        ?>
                                        <tr>
                                            <td><?= $anuncio->id_anuncio ?></td>
                                            <td>
                                                <?php
                                                    $fornecedor = (new \Source\Models\Fornecedores())->find("id = :fid","fid={$anuncio->fornecedor}")->fetch(true);
                                                    echo $fornecedor["0"]->nome;
                                                ?>
                                            </td>
                                            <td><?= $anuncio->description ?></td>
                                            <td><a target="_blank" href="<?= $anuncio->link ?>"><i class="align-middle" data-feather="link"></i></a></td>
                                            <td>
                                                <?php
                                                $date = new DateTime($anuncio->dt_anuncio);
                                                echo $date->format("d/m//Y");
                                                ?>
                                            </td>
                                            <td><?= "R$ ".number_format($anuncio->valor,2,",",".") ?></td>
                                            <td class="table-action">
                                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                    endforeach;
                                else:
                                    echo "esse cliente ainda não possui projetos";
                                endif;
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!--Painel Financeiro-->
                <div class="tab-pane fade" id="financeiro" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Faturas</h5>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:20%;">Nosso Numero</th>
                                    <th style="width:20%;">Valor</th>
                                    <th style="width:20%;">Vencimento</th>
                                    <th style="width:20%;">Status</th>
                                    <th style="width:20%;">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if ($faturas):
                                        foreach ($faturas as $fatura):
                                    ?>
                                    <tr>
                                        <td><?= $fatura->nosso_numero ?></td>
                                        <td><?= "R$".number_format($fatura->valor,2,",","."); ?></td>
                                        <td><?php $date = new DateTime($fatura->vencimento);
                                                echo $date->format("d/m/Y");
                                            ?></td>
                                        <td><?= $fatura->status_fatura()->desc_status ?></td>
                                        <td class="table-action">
                                            <a href="#"><i class="align-middle" data-feather="check-circle"></i></a>
                                            <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                        </td>
                                    </tr>

                                    <?php
                                        endforeach;
                                        else:
                                            echo "esse cliente ainda não possui faturas";
                                        endif;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!--Painel credenciais-->
                <div class="tab-pane fade" id="credenciais" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Credenciais</h5>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:20%;">Serviço</n></th>
                                    <th style="width:20%;">Login</th>
                                    <th style="width:20%;">Senha</th>
                                    <th style="width:20%;">Obs</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($credentials):
                                    foreach ($credentials as $credential):
                                        ?>
                                        <tr>
                                            <td><?= $credential->servico ?></td>
                                            <td><?= $credential->login?></td>
                                            <td><?= $credential->senha?></td>
                                            <td><?= $credential->obs ?></td>
                                        </tr>

                                    <?php
                                    endforeach;
                                else:
                                    echo "esse cliente ainda não possui credenciais";
                                endif;
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!--Painel Usuario-->
                <div class="tab-pane fade" id="usuario" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Usuarios</h5>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:20%;">Nome</n></th>
                                    <th style="width:20%;">Email</th>
                                    <th style="width:20%;">Grupo</th>
                                    <th style="width:20%;">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($users):
                                    foreach ($users as $user):
                                        ?>
                                        <tr>
                                           <td><?= $user->first_name." ".$user->last_name ?></td>
                                            <td><?= $user->email?></td>
                                            <td><?= $user->id_grupo ?></td>
                                            <td class="table-action">
                                                <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                    endforeach;
                                else:
                                    echo "esse cliente ainda não usuários cadastrados";
                                endif;
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>