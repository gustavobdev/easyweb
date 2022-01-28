<?php $this->layout("/dashboard/_theme");
messageDash();
?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-9 col-xl-6">
            <div class="tab-content">
                <!--Painel de dados da aplicação-->
                <div class="tab-pane fade show active" id="geral" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Gerencie os usuários</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= $url ?>console/cria/usuario" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Nome</label>
                                                <input type="text" name="nome" class="form-control" id="inputUsername">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Sobrenome</label>
                                                <input type="text" name="sobrenome" class="form-control" id="inputUsername">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Email</label>
                                            <input type="email" name="email" class="form-control" id="inputUsername">
                                        </div>
                                        <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label" for="inputUsername">Contato</label>
                                            <input type="text" name="contato" class="form-control" id="inputUsername">
                                        </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Setor</label>
                                                <select class="form-control" type="select" name="tipo">
                                                    <option disabled selected> Selecione um nivel </option>
                                                    <option value="1"> Master </option>
                                                    <option value="2"> Operacional </option>
                                                    <option value="3"> Financeiro </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6 mb-3">
                                                <button type="submit" class="btn btn-primary">Criar usuário</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">

                <div class="row">
                    <div class="text-center">
                        <h4>Número de usuários</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Contas Master</h5>
                                <h3 class="mt-1 mb-3"><?= $admin ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Contas Operacional</h5>
                                <h3 class="mt-1 mb-3"><?= $operacional ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Contas Financeiro</h5>
                                <h3 class="mt-1 mb-3"><?= $financeiro ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total de Usuarios</h5>
                                <h3 class="mt-1 mb-3"><?= $users ?></h3>
                                <div class="text-center">
                                    <a href="<?=url("console/members")?>" class="badge btn-primary">Ver todos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>