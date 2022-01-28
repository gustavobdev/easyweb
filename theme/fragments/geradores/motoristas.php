<?php $this->layout("/dashboard/_theme");
messageDash();
?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <form action="<?= $url ?>console/cria/motorista" method="post">
        <div class="row">
            <div class="text-center mt-4">
                <h1 class="h2">Novo Motorista</h1>
                <p class="lead">
                    Insira aqui um novo caminhoneiro no sistema.
                </p>
            </div>
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab4">Informações Pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab5">Informações Bancárias</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="nome">Nome</label>
                                        <input type="text" name="nome" class="form-control" id="nome" autocomplete="off">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="sobrenome">Sobrenome</label>
                                        <input type="text" name="sobrenome" class="form-control" id="sobrenome" autocomplete="off">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-3">
                                        <label class="form-label" for="cpf">CPF</label>
                                        <input type="text" name="cpf" class="form-control" id="cpf" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="rg">RG</label>
                                        <input type="text" name="rg" class="form-control" id="rg" onkeypress="$(this).mask('00.000.0009');" autocomplete="off">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="cnh">CNH</label>
                                        <input type="text" name="cnh" class="form-control" id="cnh" onkeypress="$(this).mask('00000000000');" autocomplete="off">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="validadecnh">Validade CNH</label>
                                        <input type="date" name="validadecnh" class="form-control" id="validadecnh" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label class="form-label" for="phone1">Telefone Principal</label>
                                        <input type="text" name="phone1" class="form-control" id="phone1" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="cep">CEP<small> (Preenchimento automatico)</small></label>
                                        <input type="text" name="cep" class="form-control" id="cep" onblur="pesquisacep(this.value)" onkeypress="$(this).mask('00000-000');" autocomplete="off">
                                    </div>
                                    <div class="col-5">
                                        <label class="form-label" for="rua">Rua</label>
                                        <input type="text" name="rua" id="rua" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-1">
                                        <label class="form-label" for="numero">Nº</label>
                                        <input type="text" name="numero" id="numero" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="bairro">Bairro</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="cidade">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="estado">Estado</label>
                                        <input type="text" name="estado" id="estado" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="indivisivel" id="indivisivel">
                                    <label class="form-check-label" for="indivisivel">Possui certificado de carca indivisível</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="mopp" type="checkbox" id="mopp">
                                    <label class="form-check-label" for="mopp">Possui certificado MOPP</label>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab5" role="tabpanel">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label" for="agencia">Agência <small>(Pesquise com o digito da agência)</small></label>
                                        <input type="search" name="agencia" class="form-control" id="agencia" list="bancos">
                                        <datalist id="bancos">
                                            <?php
                                            foreach ($banks as $bank) :
                                            ?>
                                                <option value="<?= $bank->banco ?>"></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="conta">Conta</label>
                                        <input type="text" name="conta" class="form-control" id="conta" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label" for="titular">Nome do titular da conta</label>
                                        <input type="text" name="titular" class="form-control" id="titular" autocomplete="off">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="cpf_conta">CPF do titular da conta</label>
                                        <input type="text" name="cpf_conta" class="form-control" id="cpf_conta" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10"></div>
            <button type="submit" class="col-2 btn btn-primary">Adicionar Motorista</button>
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
