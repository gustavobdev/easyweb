<?php $this->layout("/dashboard/_theme");
messageDash();
if (!isset($_SESSION)) {
    session_start();
}
?>


<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Visão geral de Clientes cadastrados no console</h5>
                <small><b>Filtrar por: razão social, cnpj, email, telefone, celular e website.</b></small>
            </div>
            <?php if ($clients) : ?>
                <div class="card-body">
                    <?php if ($_SESSION["nl_acesso"] === "1") : ?>
                        <div class="col-2 mb-3">
                            <button class="btn btn-primary" data-toggle='modal' data-target='#modalCliente'>Adicionar novo cliente</button>
                        </div>
                        <table class="table table-stripped" id="clienttable">
                            <thead>
                                <tr>
                                    <th>Razão Social</th>
                                    <th>CNPJ</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>WebSite</th>
                                    <th style="width: 10%;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*@var Clients*/
                                foreach ($clients as $client) :
                                ?>
                                    <tr>
                                        <td><?= $client->razao_social ?></td>
                                        <td><?= $client->cnpj ?></td>
                                        <td><?= $client->email ?></td>
                                        <td><?= $client->telefone ?></td>
                                        <td><?= $client->celular ?></td>
                                        <td><?= $client->website ?></td>
                                        <td class="table-action">
                                            <button class="btn btn-outline-dark fas fa-sync-alt" style=" border: none;" data-id="<?= $client->id ?>" data-actione="<?= url("console/fetch/cliente") ?>"></button>
                                            <button data-action="<?= url("console/destroy/cliente") ?>" class=" btn btn-outline-danger fa fa-trash" data-id="<?= $client->id ?>" aria-hidden="true" style=" border: none;"></button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <table class="table" id="clienttable">
                            <thead>
                                <tr>
                                    <th>Razão Social</th>
                                    <th>CNPJ</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>WebSite</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*@var Clients*/
                                foreach ($clients as $client) :
                                ?>
                                    <tr>
                                        <td><?= $client->razao_social ?></td>
                                        <td><?= $client->cnpj ?></td>
                                        <td><?= $client->email ?></td>
                                        <td><?= $client->telefone ?></td>
                                        <td><?= $client->website ?></td>

                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <h4>Nenhum cliente na base de dados</h4>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Edit cliente -->
    <div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="<?= url("console/upgradeclient") ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Empresa <span id="clientname"></span></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="form-label" for="cliente_razaosocial">Razão Social</label>
                                <input type="text" name="cliente_razaosocial" class="form-control" id="cliente_razaosocial" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_nomefantasia">Nome fantasia</label>
                                <input type="text" name="cliente_nomefantasia" class="form-control" id="cliente_nomefantasia" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_inscricaoestadual">Inscrição Estadual</label>
                                <input type="text" name="cliente_inscricaoestadual" class="form-control" id="cliente_inscricaoestadual" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="form-label" for="cliente_cnpj">CNPJ</label>
                                <input type="text" name="cliente_cnpj" class="form-control" id="cliente_cnpj" onkeypress="$(this).mask('00.000.000/0000-00');" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_contato">Contato<small> (Tel/ @ social / outros)</small></label>
                                <input type="text" name="cliente_contato" class="form-control" id="cliente_contato" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_phone">Telefone Principal</label>
                                <input type="text" name="cliente_phone" class="form-control" id="cliente_phone" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="form-label" for="cliente_celular">Celular</label>
                                <input type="text" name="cliente_celular" class="form-control" id="cliente_celular" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_email">Email</label>
                                <input type="email" name="cliente_email" class="form-control" id="cliente_email" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_site">WebSite</label>
                                <input type="text" name="cliente_site" class="form-control" id="cliente_site" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3">
                                <label class="form-label" for="cliente_cep">CEP</label>
                                <input type="text" name="cliente_cep" class="form-control" id="cliente_cep" onblur="pesquisacep2(this.value)" onkeypress="$(this).mask('00000-000');" autocomplete="off">
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="cliente_rua">Rua</label>
                                <input type="text" name="cliente_rua" class="form-control" id="cliente_rua" autocomplete="off">
                            </div>
                            <div class="col-3">
                                <label class="form-label" for="cliente_numero">Numero</label>
                                <input type="text" name="cliente_numero" id="cliente_numero" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="form-label" for="cliente_bairro">Bairro</label>
                                <input type="text" name="cliente_bairro" class="form-control" id="cliente_bairro" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_cidade">Cidade</label>
                                <input type="text" name="cliente_cidade" class="form-control" id="cliente_cidade" autocomplete="off">
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="cliente_estado">Estado</label>
                                <input type="text" name="cliente_estado" class="form-control" id="cliente_estado" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <input type="hidden" name="client_id" class="form-control" id="client_id">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar cliente</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal Edit cliente -->

    <!-- Modal novo Cliente -->
    <div class="modal fade bd-example-modal-lg" id="modalCliente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?= url("console/cria/cliente2") ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo motorista</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
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
                                                <label class="form-label" for="razao">Razão Social</label>
                                                <input type="text" name="razao" class="form-control" id="razao" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="nome_fantasia">Nome fantasia</label>
                                                <input type="text" name="nome_fantasia" class="form-control" id="nome_fantasia" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="inscricao_estadual">Inscrição Estadual</label>
                                                <input type="text" name="inscricao_estadual" class="form-control" id="inscricao_estadual" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-4">
                                                <label class="form-label" for="cnpj">CNPJ</label>
                                                <input type="text" name="cnpj" class="form-control" id="cnpj" onkeypress="$(this).mask('00.000.000/0000-00');" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="contato">Contato<small> (Tel/ @ social / outros)</small></label>
                                                <input type="text" name="contato" class="form-control" id="contato" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="phone">Telefone Principal</label>
                                                <input type="text" name="phone" class="form-control" id="phone" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label class="form-label" for="celular">Celular</label>
                                                <input type="text" name="celular" class="form-control" id="celular" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="site">WebSite</label>
                                                <input type="text" name="site" id="site" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <label class="form-label" for="cep">CEP</label>
                                                <input type="text" name="cep" id="cep" class="form-control" onblur="pesquisacep(this.value)" onkeypress="$(this).mask('00000-000');" autocomplete="off">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="rua">Rua</label>
                                                <input type="text" name="rua" id="rua" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="numero">Numero</label>
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar cliente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal novo Cliente -->





    <?php $this->push("scripts") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clienttable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ]
            });
            $('body').on("click", "[data-action]", function(e) {
                e.preventDefault();
                var data = $(this).data();
                var $tr = $(this).closest("tr");

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Excluir cliente!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(data.action, data, function(data) {
                            console.log(data);
                            Swal.fire({
                                icon: data.icon,
                                title: data.title,
                                text: data.msg
                            });
                            if (data.success) {
                                $tr.fadeOut();
                            }
                        }, "json").fail(function() {
                            alert("Erro ao processar requisição");
                        });
                    }
                });

            });
            $('body').on("click", "[data-actione]", function(e) {
                e.preventDefault();
                var data = $(this).data();

                $.post(data.actione, data, function(data) {
                    $("#modalEdit").modal('show');
                    $("#client_id").val(data.id);
                    $("#clientname").html(data.clientname)
                    $("#cliente_razaosocial").val(data.razao);
                    $("#cliente_nomefantasia").val(data.fantasia);
                    $("#cliente_inscricaoestadual").val(data.estadual);
                    $("#cliente_cnpj").val(data.cnpj);
                    $("#cliente_contato").val(data.contato);
                    $("#cliente_phone").val(data.telefone);
                    $("#cliente_celular").val(data.celular);
                    $("#cliente_email").val(data.email);
                    $("#cliente_site").val(data.website);
                    $("#cliente_cep").val(data.cep);
                    $("#cliente_rua").val(data.rua);
                    $("#cliente_numero").val(data.numero);
                    $("#cliente_bairro").val(data.bairro);
                    $("#cliente_cidade").val(data.cidade);
                    $("#cliente_estado").val(data.estado);


                }, "json").fail(function() {
                    alert("Erro ao processar requisição");
                });
            });

        });

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


        function limpa_formulário_cep2() {
            //Limpa valores do formulário de cep.
            document.getElementById('cliente_rua').value = ("");
            document.getElementById('cliente_bairro').value = ("");
            document.getElementById('cliente_cidade').value = ("");
            document.getElementById('cliente_estado').value = ("");
        }

        function meu_callback2(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('cliente_rua').value = (conteudo.logradouro);
                document.getElementById('cliente_bairro').value = (conteudo.bairro);
                document.getElementById('cliente_cidade').value = (conteudo.localidade);
                document.getElementById('cliente_estado').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep2();
                $(document).ready(function() {
                    $("#modalbody").html('Cep Não Encontrado');
                    $("#declinecep").modal();
                });

            }
        }

        function pesquisacep2(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.

                    document.getElementById('cliente_rua').value = "...";
                    document.getElementById('cliente_bairro').value = "...";
                    document.getElementById('cliente_cidade').value = "...";
                    document.getElementById('cliente_estado').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback2';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep2();


                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep2();
            }
        }
</script>


    <?php $this->end() ?>