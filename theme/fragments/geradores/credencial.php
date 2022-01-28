
<?php $this->layout("/dashboard/_theme");?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-9 col-xl-6">
            <div class="tab-content">
                <!--Painel de dados da aplicação-->
                <div class="tab-pane fade show active" id="geral" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Gerencie as credenciais do cliente</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= $url?>console/cria/credencial" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Cliente</label>
                                            <select class="form-control" type="select" name="cliente">
                                               <option value="0"> Selecione um cliente </option>
                                               <?php
                                               if ($clientes):
                                               foreach ($clientes as $cliente):
                                               ?>
                                               <option value="<?= $cliente->id ?>"> <?= $cliente->razao ?> </option>
                                               <?php
                                               endforeach;
                                               else:
                                               echo "Não existem clientes cadastrados";
                                               endif;
                                               ?>
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Serviço</label>
                                                <input type="text" name="servico" class="form-control" id="inputUsername" >
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">link</label>
                                                <input type="text" name="link" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Login</label>
                                                <input type="text" name="login" class="form-control" id="inputUsername" >
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Senha</label>
                                                <input type="text" name="senha" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label class="form-label" for="inputUsername">Obs</label>
                                                <input type="text" name="obs" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Criar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>