
<?php $this->layout("/dashboard/_theme");?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <!--Painel de dados da aplicação-->
                <div class="tab-pane fade show active" id="geral" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informe a campanha criada</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= $url?>console/cria/anuncio" method="post">
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
                                                <label class="form-label" for="inputUsername">Fornecedor</label>
                                                <select class="form-control" type="select" name="fornecedor">
                                                    <option value="0"> Selecione um fornecedor </option>
                                                    <?php
                                                    if ($fornecedores):
                                                        foreach ($fornecedores as $fornecedor):
                                                            ?>
                                                            <option value="<?= $fornecedor->id ?>"> <?= $fornecedor->nome ?> </option>
                                                        <?php
                                                        endforeach;
                                                    else:
                                                        echo "Não existem fornecedores cadastrados";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Ref Fornecedor</label>
                                                <input type="text" name="ref_fornecedor" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">link da campanha</label>
                                            <input type="text" name="link" class="form-control" id="inputUsername" >
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Data</label>
                                                <input type="date" name="data" class="form-control" id="inputUsername" >
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Valor</label>
                                                <input type="text" name="valor" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Descrição do anúncio</label>
                                            <textarea type="text" name="descricao" class="form-control" id="inputUsername"></textarea>
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