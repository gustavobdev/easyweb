<?php $this->layout("/dashboard/_theme");
messageDash();
?>

<?php $url = URL_BASE ?>
<div class="container-fluid p-0">
    <form action="<?= $url ?>console/cria/cliente" method="post">
        <div class="row">
            <div class="text-center mt-4">
                <h1 class="h2">Novo Cliente</h1>
                <p class="lead">
                    Insira aqui um novo cliente no sistema.
                </p>
            </div>
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab4">Informações da Empresa</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Razão Social</label>
                                        <input type="text" name="razao" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Nome fantasia</label>
                                        <input type="text" name="nome_fantasia" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Inscrição Estadual</label>
                                        <input type="text" name="inscricao_estadual" class="form-control" id="inputUsername">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">CNPJ</label>
                                        <input type="text" name="cnpj" class="form-control" id="inputUsername" onkeypress="$(this).mask('00.000.000/0000-00');">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Contato<small> (Tel/ @ social / outros)</small></label>
                                        <input type="text" name="contato" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Telefone Principal</label>
                                        <input type="text" name="phone" class="form-control" id="inputUsername" onkeypress="$(this).mask('(00) 0000-00009')">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Celular</label>
                                        <input type="text" name="celular" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">WebSite</label>
                                        <input type="text" name="site" id="site" class="form-control" id="inputUsername">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label class="form-label" for="inputUsername">CEP</label>
                                        <input type="text" name="cep" id="cep" class="form-control" id="inputUsername" onblur="pesquisacep(this.value)" onkeypress="$(this).mask('00000-000');">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="inputUsername">Rua</label>
                                        <input type="text" name="rua" id="rua" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label" for="inputUsername">Numero</label>
                                        <input type="text" name="numero" id="numero" class="form-control" id="inputUsername">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Bairro</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" class="form-control" id="inputUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label" for="inputUsername">Estado</label>
                                        <input type="text" name="estado" id="estado" class="form-control" id="inputUsername">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10"></div>
            <button type="submit" class="col-2 btn btn-primary">Adicionar Cliente</button>
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
