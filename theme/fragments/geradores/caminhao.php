<?php $this->layout("/dashboard/_theme");
messageDash();
?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <form action="<?= $url ?>console/cria/caminhao" method="post">
        <div class="row">
            <div class="text-center mt-4">
                <h1 class="h2">Novo Carro / Cavalo</h1>
                <p class="lead">
                    Insira aqui um novo caminhão no sistema.
                </p>
            </div>
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab4">Informações do caminhão/carro</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab5">Informações de Reboque / Cavalo</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label class="form-label" for="inputUsername">Motorista</label>
                                        <input type="search" name="motorista" class="form-control" id="inputUsername" list="motorista">
                                        <datalist name="motorista" id="motorista">
                                            <?php
                                            foreach ($motoristas as $motorista) :
                                            ?>
                                                <option value="<?= $motorista->id ?>"><?= $motorista->nome . " " . $motorista->sobrenome ?> </option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="inputUsername">Renavam</label>
                                        <input type="text" name="renavam_caminhao" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="validade_renavamcam">Validade Renavam</label>
                                        <input type="date" name="validade_renavamcam" class="form-control" id="validade_renavamcam">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="inputUsername">Placa</label>
                                        <input type="text" name="placa_caminhao" class="form-control" id="inputUsername">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Modelo</label>
                                        <input type="text" name="modelo_caminhao" class="form-control" id="inputUsername">
                                    </div>

                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Cor</label>
                                        <input type="text" name="cor" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Tipo</label>
                                        <select class="form-control" name="tipo_caminhao">
                                            <option></option>
                                            <option value="Baú">Baú</option>
                                            <option value="Reboque">Reboque</option>
                                            <option value="Sider">Sider</option>
                                            <option value="Van">Van</option>
                                            <option value="Furgão">Furgão</option>
                                            <option value="Doblo">Doblo</option>
                                            <option value="Carro baixo">Carro baixo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                    <label for="obs_caminhao">Observações do veículo</label>
                                    <textarea class="form-control" name="obs_caminhao" id="obs_caminhao"  rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <input type="checkbox" name="caminhao_interno" id="caminhao_interno" />
                                        <label for="caminhao_interno" style="color: blue;">Marque esta opção caso este veículo seja de um motorista interno</label>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab5" role="tabpanel">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Renavam</label>
                                        <input type="text" name="renavam_reboque" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="validade_renavamreb">Validade Renavam</label>
                                        <input type="date" name="validade_renavamreb" class="form-control" id="validade_renavamreb">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="inputUsername">Placa</label>
                                        <input type="text" name="placa_reboque" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="inputUsername">Modelo</label>
                                        <input type="text" name="modelo_reboque" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label" for="inputUsername">Tipo</label>
                                        <select class="form-control" name="tipo_reboque">
                                            <option></option>
                                            <option value="Sider">Sider</option>
                                            <option value="Carreta">Carreta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <input type="checkbox" name="reboque_interno" id="reboque_interno" />
                                        <label for="reboque_interno" style="color: blue;">Marque esta opção caso este veículo seja de um motorista interno</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9"></div>
            <button type="submit" class="col-3 btn btn-primary">Adicionar Caminhão</button>
        </div>
    </form>

</div>

<?php $this->push("scripts"); ?>
<script>
    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('estado').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('estado').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            $(document).ready(function() {
                $("#modalbody").html('Cep Não Encontrado');
                $("#declinecep").modal();
            });

        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.

                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('estado').value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $(document).ready(function() {
                    $("#modalbody").html('Formato de CEP inválido');
                    $("#declinecep").modal();
                });

            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<?php $this->end();
