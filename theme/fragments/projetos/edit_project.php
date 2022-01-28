<?php $this->layout("/dashboard/_theme");?>

<?php /** @var TYPE_NAME $project */?>

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
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#cliente" role="tab">
                        Dados do Cliente
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#documentos" role="tab">
                        Documentos
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#entregas" role="tab">
                        Entregas
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
                                            <input type="text" class="form-control" id="inputUsername" value="<?=  $project["0"]->nome ?>" placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Descrição</label>
                                            <textarea rows="2" class="form-control" id="inputBio"  placeholder="<?= $project["0"]->decricao ?>"></textarea>
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
                                        <input type="text" class="form-control" id="inputFirstName" value="<?= $project['0']->clients()->razao ?>">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputLastName">CNPJ</label>
                                        <input type="text" class="form-control" id="inputLastName" value="<?= $project['0']->clients()->cnpj ?>" >
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" value="<?= $project['0']->clients()->setor ?>" placeholder="Email">
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
                                            <input type="text" class="form-control" id="inputFirstName" value="<?= $project['0']->clients()->razao ?>">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputLastName">Arquivo</label>
                                            <input type="file" class="form-control" id="inputLastName" value="<?= $project['0']->clients()->cnpj ?>" >
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

                <!--Painel de Entregas-->
                <div class="tab-pane fade" id="entregas" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Entregas</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= $url?>console/projetos/entrega" method="post">
                                <div class="row">
                                        <input style="display: none" name="projeto" value="<?= $project[0]->nome ?>">
                                        <input style="display: none" name="id" value="<?= $project[0]->id ?>">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="inputFirstName">Tema</label>
                                        <input type="text" class="form-control" name="tema"  id="inputFirstName" value="">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="inputLastName">Hora(s)</label>
                                        <input type="text" class="form-control" name="hora" id="inputLastName" value="" >
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="inputLastName">Data</label>
                                        <input type="date" class="form-control" name="data" id="inputLastName" value="" >
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputEmail4">Descrição</label>
                                    <textarea type="text" rows="4" class="form-control" name="descricao" id="inputEmail4" value=""></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">incluir</button>
                            </form>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:20%;">Tema</th>
                                    <th style="width:5%;">Hora(s)</th>
                                    <th style="width:10%;">Data</th>
                                    <th style="width:25%;">Descrição</th>
                                    <th style="width:5%;">Usuário</th>
                                    <th style="width:5%;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($entregas):
                                        foreach ($entregas as $entrega):
                                    ?>
                                            <tr>
                                                <td><?= $entrega->tema ?></td>
                                                <td><?= $entrega->horas ?></td>
                                                <td>
                                                    <?php
                                                    $date = new DateTime($entrega->dt_entrega);
                                                    echo $date->format("d/m/Y")
                                                    ?>
                                                </td>
                                                <td><?= $entrega->description ?></td>
                                                <td><?= $entrega->id_user ?></td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    ?>
                                </tbody>
                                <?php
                                else:
                                    echo "<tr>Ainda não ha atividades apontas</tr>";
                                endif;
                                ?>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>