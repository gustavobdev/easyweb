
<?php $this->layout("/dashboard/_theme");?>

<?php var_dump($projetos["0"]->clients()["0"]->razao); ?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <!--Painel de dados da aplicação-->
                <div class="tab-pane fade show active" id="geral" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Adicione um novo Lançamento</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= $url?>console/cria/fatura" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Projeto</label>
                                            <select class="form-control" type="select" name="projeto">
                                               <option value="0"> Selecione um cliente </option>
                                               <?php
                                               if ($projetos):
                                               foreach ($projetos as $projeto["0"]):
                                               ?>
                                                   <option value="<?= $projetos->id ?>"> <?= $projeto["0"]->clients()["0"]->razao." - ".$projeto["0"]->nome ?> </option>
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
                                                <label class="form-label" for="inputUsername">Nosso Número</label>
                                                <input type="text" name="nosso_numero" class="form-control" id="inputUsername" >
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Valor</label>
                                                <input type="text" name="valor" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Status</label>
                                            <select class="form-control" id="fds" name="status">
                                                <option value="">Escolha um status</option>
                                                <?php
                                                if ($status):
                                                    foreach ($status as $statu):
                                                ?>
                                                        <option value="<?= $statu->id ?>"> <?= $statu->desc_status ?> </option>
                                                <?php
                                                     endforeach;
                                                else:
                                                    echo "não existem dados nessa tabela";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Data de Vencimento</label>
                                                <input type="date" name="vencimento" class="form-control" id="inputUsername" >
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="inputUsername">Data da Baixa</label>
                                                <input type="date" name="baixa" class="form-control" id="inputUsername" >
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Descrição da Baixa</label>
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