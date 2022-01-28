
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
                            <h5 class="card-title mb-0">Crie um <strong>Perfil Direto</strong> de caminhoneiro</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= $url?>console/cria/projeto" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Nome</label>
                                            <input type="text" name="nome" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Sobrenome</label>
                                            <input type="text" name="sobrenome" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Email</label>
                                            <input type="email" name="email" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Senha provisória</label>
                                            <input type="password" name="senha" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Data de Nascimento</label>
                                            <input type="date" name="data_nasc" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Sexo</label>
                                            <select type="text" name="sexo" class="form-control" id="inputUsername" >
                                                <option value="0">-</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">RG</label>
                                            <input type="text" name="rg" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">CPF</label>
                                            <input type="text" name="cpf" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">CNH</label>
                                            <input type="text" name="cnh" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Categoria</label>
                                            <select type="text" name="categoria" class="form-control" id="inputUsername" >
                                                <option value="0">-</option>
                                                <option value="1">B</option>
                                                <option value="2">C</option>
                                                <option value="3">D</option>
                                                <option value="4">E</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Vencimento CNH</label>
                                            <input type="date" name="venc_cnh" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">MOPP</label>
                                            <input type="date" name="mopp" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Dados do Veículo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Modelo</label>
                                            <input type="text" name="modelo" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Placa</label>
                                            <input type="text" name="placa" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Renavam</label>
                                            <input type="text" name="renavam" class="form-control" id="inputUsername" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Tipo de roboque</label>
                                            <input type="text" name="tipo_reboque" class="form-control" id="inputUsername" >
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