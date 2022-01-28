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
                <h5 class="card-title">Visão geral de Motoristas cadastrados no aplicativo</h5>
                <small><b>Filtrar por: nome, sobrenome, email, cpf, rg e cnh.</b></small>
            </div>
            <?php if ($drivers) : ?>
                <div class="card-body">

                    <?php if ($_SESSION["nl_acesso"] === "1") : ?>
                        <div class="col-2 mb-3">
                            <button class="btn btn-primary" data-toggle='modal' data-target='#modalStatus'>Adicionar novo motorista</button>
                        </div>
                        <table class="table" id="usertable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>Email</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>CNH</th>
                                    <th style="width: 10%;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*@var Clients*/
                                foreach ($drivers as $driver) :
                                ?>
                                    <tr>
                                        <td> <?php if (isset($driver->profile_photo)) : ?>
                                                <img src="<?= url("{$driver->profile_photo}") ?>" alt="avatar" class="imaged w100 " style="width: 50px; height: 50px; border-radius: 200px; overflow: hidden;">
                                            <?php else : ?>
                                                <img src="<?= url("assets/app/assets/img/sample/avatar/avatar1.jpg") ?>" alt="avatar" class="imaged w100 rounded" style="width: 50px; height: 50px; border-radius: 200px; overflow: hidden;">

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($driver->status_conta === "1") : ?>
                                                <span class='badge  btn-success'><?= $driver->status()[0]->status_desc ?></span>
                                            <?php elseif ($driver->status_conta === "2") : ?>
                                                <span class='badge  btn-warning'><?= $driver->status()[0]->status_desc ?></span>
                                            <?php elseif ($driver->status_conta === "3") : ?>
                                                <span class='badge  btn-danger'><?= $driver->status()[0]->status_desc ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $driver->nome ?></td>
                                        <td><?= $driver->sobrenome ?></td>
                                        <td><?= $driver->email ?></td>
                                        <td><?= $driver->cpf ?></td>
                                        <td><?= $driver->rg ?></td>
                                        <td><?= $driver->cnh ?></td>
                                        </td>
                                        <td class="table-action">
                                            <button data-id="<?= $driver->id ?>" data-actione="<?= url("console/fetch/driver") ?>" class="btn btn-outline-dark fas fa-sync-alt" aria-hidden="true" style=" border: none;"></button>
                                            <button data-action="<?= url("console/destroy/motorista") ?>" class=" btn btn-outline-danger fa fa-trash" data-id="<?= $driver->id ?>" aria-hidden="true" style=" border: none;"></button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <table class="table" id="usertable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>Email</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>CNH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*@var Clients*/
                                foreach ($drivers as $driver) :
                                ?>
                                    <tr>
                                        <form method="post" action="<?= url("console/upgradedriver") ?>">
                                            <td> <?php if (isset($driver->profile_photo)) : ?>
                                                    <img src="<?= url("{$driver->profile_photo}") ?>" alt="avatar" class="imaged w100 " style="width: 50px; height: 50px; border-radius: 200px; overflow: hidden;" />
                                                <?php else : ?>
                                                    <img src="<?= url("assets/app/assets/img/sample/avatar/avatar1.jpg") ?>" alt="avatar" class="imaged w100 rounded" style="width: 50px; height: 50px; border-radius: 200px; overflow: hidden;" />

                                                <?php endif; ?>
                                            </td>
                                            <td><?= $driver->nome ? $driver->nome : 'Não cadastrado' ?></td>
                                            <td><?= $driver->sobrenome ? $driver->sobrenome : 'Não cadastrado' ?></td>
                                            <td><?= $driver->email ? $driver->email : 'Não cadastrado' ?></td>
                                            <td><?= $driver->cpf ? $driver->cpf : 'Não cadastrado' ?></td>
                                            <td><?= $driver->rg ? $driver->rg : 'Não cadastrado' ?></td>
                                            <td><?= $driver->cnh ? $driver->cnh : 'Não cadastrado' ?></td>
                                        </form>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <h4>Nenhum membro na base de dados</h4>
            <?php endif; ?>
        </div>
    </div>
    <!-- Modal new motorista -->
    <div class="modal fade bd-example-modal-lg" id="modalStatus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?= url("console/cria/motorista2") ?>" method="post">
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
                                                    foreach ($bancos as $banco) :
                                                    ?>
                                                        <option value="<?= $banco->banco ?>"></option>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar motorista</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal new motorista -->

    <!-- Modal edit motorista -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" action="<?= url("console/upgradedriver") ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil de <span id="driver_nome1"></span></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs pull-right" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab6">Informações Pessoais</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab7">Informações Bancárias</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab6" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <label class="form-label" for="driver_status">Status da conta</label>
                                                <select name="driver_status" class="form-control" id="driver_status">
                                                    <option id="driverstatus" selected disabled>Selecione</option>
                                                    <?php foreach ($status_conta as $statu) :
                                                        if ($statu->id === "1") :  ?>
                                                            <option class="text-success" value="<?= $statu->id ?>"><?= $statu->status_desc ?></option>
                                                        <?php endif;
                                                        if ($statu->id === "2") : ?>
                                                            <option class="text-warning"  value="<?= $statu->id ?>"><?= $statu->status_desc ?></option>

                                                        <?php endif;
                                                        if ($statu->id === "3") : ?>
                                                            <option class="text-danger"  value="<?= $statu->id ?>"><?= $statu->status_desc ?></option>

                                                    <?php endif;
                                                    endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_nome">Nome</label>
                                                <input type="text" name="driver_nome" class="form-control" id="driver_nome" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_sobrenome">Sobrenome</label>
                                                <input type="text" name="driver_sobrenome" class="form-control" id="driver_sobrenome" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_email">Email</label>
                                                <input type="email" name="driver_email" class="form-control" id="driver_email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-3">
                                                <label class="form-label" for="driver_cpf">CPF</label>
                                                <input type="text" name="driver_cpf" class="form-control" id="driver_cpf" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_rg">RG</label>
                                                <input type="text" name="driver_rg" class="form-control" id="driver_rg" onkeypress="$(this).mask('00.000.0009');" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_cnh">CNH</label>
                                                <input type="text" name="driver_cnh" class="form-control" id="driver_cnh" onkeypress="$(this).mask('00000000000');" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_validadecnh">Validade CNH</label>
                                                <input type="date" name="driver_validadecnh" class="form-control" id="driver_validadecnh" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        <div class="col-3">
                                                <label class="form-label" for="driver_phone">Telefone Principal</label>
                                                <input type="text" name="driver_phone" class="form-control" id="driver_phone" onkeypress="$(this).mask('(00) 0000-00009')" autocomplete="off">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label" for="driver_cep">CEP<small> (Preenchimento automatico)</small></label>
                                                <input type="text" name="driver_cep" id="driver_cep" class="form-control" onblur="pesquisacep2(this.value)" onkeypress="$(this).mask('00000-000');" autocomplete="off">
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label" for="driver_rua">Rua</label>
                                                <input type="text" name="driver_rua" id="driver_rua" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="col-1">
                                                <label class="form-label" for="driver_numero">Nº</label>
                                                <input type="text" name="driver_numero" id="driver_numero" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label class="form-label" for="driver_bairro">Bairro</label>
                                                <input type="text" name="driver_bairro" id="driver_bairro" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="driver_cidade">Cidade</label>
                                                <input type="text" name="driver_cidade" id="driver_cidade" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" for="driver_estado">Estado</label>
                                                <input type="text" name="driver_estado" id="driver_estado" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="driver_indivisivel" id="driver_indivisivel">
                                            <label class="form-check-label" for="driver_indivisivel">Possui certificado de carca indivisível</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="driver_mopp" type="checkbox" id="driver_mopp">
                                            <label class="form-check-label" for="driver_mopp">Possui certificado MOPP</label>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab7" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="driver_agencia">Agência <small>(Pesquise com o digito da agência)</small></label>
                                                <input type="search" name="driver_agencia" class="form-control" id="driver_agencia" list="bancos">
                                                <datalist id="bancos">
                                                    <?php
                                                    foreach ($bancos as $banco) :
                                                    ?>
                                                        <option value="<?= $banco->banco ?>"></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </datalist>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="driver_conta">Conta</label>
                                                <input type="text" name="driver_conta" class="form-control" id="driver_conta" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label" for="driver_titular">Nome do titular da conta</label>
                                                <input type="text" name="driver_titular" class="form-control" id="driver_titular" autocomplete="off">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="driver_cpftitular">CPF do titular da conta</label>
                                                <input type="text" name="driver_cpftitular" class="form-control" id="driver_cpftitular" onkeypress="$(this).mask('000.000.000-00');" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" id="driver_id" name="driver_id">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <?php $this->push("scripts") ?>
    <script>
        $(document).ready(function() {

            $('#usertable').DataTable({
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
                    confirmButtonText: 'Sim, Excluir usuário!',
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
                        }, "json").fail(function(data) {
                            console.log(data);
                            alert("Erro ao processar requisição");
                        });
                    }
                });
            });
            $('body').on("click", "[data-actione]", function(e) {
                e.preventDefault();
                var data = $(this).data();

                $.post(data.actione, data, function(data) {
                    $("#exampleModal").modal('show');
                    $("#driver_id").val(data.id);
                    $("#driver_nome1").html(data.nomesobrenome);
                    $("#driverstatus").html(data.statusconta);
                    $("#driver_nome").val(data.nome);
                    $("#driver_sobrenome").val(data.sobrenome);
                    $("#driver_email").val(data.email);
                    $("#driver_cpf").val(data.cpf);
                    $("#driver_rg").val(data.rg);
                    $("#driver_cnh").val(data.cnh);
                    $("#driver_validadecnh").val(data.validadecnh);
                    $("#driver_phone").val(data.phone);
                    $("#driver_cep").val(data.cep);
                    $("#driver_rua").val(data.rua);
                    $("#driver_numero").val(data.numero);
                    $("#driver_bairro").val(data.bairro);
                    $("#driver_cidade").val(data.cidade);
                    $("#driver_estado").val(data.estado);
                    $("#driver_agencia").val(data.banco);
                    $("#driver_conta").val(data.conta);
                    $("#driver_titular").val(data.titular);
                    $("#driver_cpftitular").val(data.cpfconta);
                    $("#driver_indivisivel").each(function() {
                        if (data.indivisivel === '1') {
                            $(this).attr('checked', true);
                        } else
                        if (data.indivisivel === null) {
                            $(this).attr('checked', false);
                        } else
                        if (data.indivisivel === '') {
                            $(this).attr('checked', false);
                        } else
                        if (data.indivisivel === '0') {
                            $(this).attr('checked', false);
                        }
                    });
                    $("#driver_mopp").each(function() {
                        if (data.mopp === '1') {
                            $(this).attr('checked', true);
                        } else
                        if (data.mopp === null) {
                            $(this).attr('checked', false);
                        } else
                        if (data.mopp === '') {
                            $(this).attr('checked', false);
                        } else
                        if (data.mopp === '0') {
                            $(this).attr('checked', false);
                        }
                    });

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
            document.getElementById('driver_rua').value = ("");
            document.getElementById('driver_bairro').value = ("");
            document.getElementById('driver_cidade').value = ("");
            document.getElementById('driver_estado').value = ("");
        }

        function meu_callback2(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('driver_rua').value = (conteudo.logradouro);
                document.getElementById('driver_bairro').value = (conteudo.bairro);
                document.getElementById('driver_cidade').value = (conteudo.localidade);
                document.getElementById('driver_estado').value = (conteudo.uf);
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

                    document.getElementById('driver_rua').value = "...";
                    document.getElementById('driver_bairro').value = "...";
                    document.getElementById('driver_cidade').value = "...";
                    document.getElementById('driver_estado').value = "...";

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
                    $(document).ready(function() {
                        $("#modalbody").html('Formato de CEP inválido');
                        $("#declinecep").modal();
                    });

                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep2();
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


    <?php $this->end() ?>