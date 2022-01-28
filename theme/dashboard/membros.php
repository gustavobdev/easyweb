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
                <h5 class="card-title">Visão geral de Usuários cadastrados no console</h5>
                <small><b>Filtrar por: nome, sobrenome, setor/nivel, email, telefone, data de cadastro e último acesso.</b></small>
            </div>
            <?php if ($users) : ?>
                <div class="card-body">

                    <?php if ($_SESSION["nl_acesso"] === "1") : ?>
                        <div class="col-2 mb-3">
                            <button class="btn btn-primary" data-toggle='modal' data-target='#modalStatus'>Adicionar novo usuário</button>
                        </div>
                        <table class="table table-stripped" id="usertable">
                            <thead>

                                <tr>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>Setor/Nivel</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Data de cadastro</th>
                                    <th>Último acesso</th>
                                    <th style="width: 10%;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*@var Clients*/
                                foreach ($users as $user) :
                                ?>
                                    <tr>
                                        <td><?= $user->nome ?></td>
                                        <td><?= $user->sobrenome ?></td>
                                        <td><?= $user->nl_acesso()[0]->desc_acesso ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->contato ?></td>
                                        <td>
                                            <?php $user->created_at ? $created_at = new DateTime($user->created_at) : $created_at = null ?>
                                            <?= $created_at ? $created_at->format("d/m/Y H:i:s") : $created_at = null; ?>
                                        </td>
                                        <td>
                                            <?php $user->last_login ? $last_login = new DateTime($user->last_login) : $last_login = null ?>
                                            <?= $last_login ? $last_login->format("d/m/Y H:i:s") : $last_login = 'Sem acessos'; ?>
                                        </td>
                                        <td class="table-action">
                                            <button class="btn btn-outline-dark fas fa-sync-alt" style="border: none;" data-id="<?= $user->id ?>" data-actione="<?= url("console/fetch/user") ?>"></button>
                                            <button data-action="<?= url("console/destroy/usuario") ?>" class=" btn btn-outline-danger fa fa-trash" data-id="<?= $user->id ?>" aria-hidden="true" style=" border: none;"></button>
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
                                    <th>Nome</th>
                                    <th>Setor/Nivel</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*@var Clients*/
                                foreach ($users as $user) :
                                ?>
                                    <tr>
                                        <td> <?= $user->nome . " " . $user->sobrenome  ?></td>
                                        <td> <strong><?= $user->nl_acesso()[0]->desc_acesso ?></strong></td>
                                        <td><?= $user->email ?> </td>

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

    <!-- Modal edit usuario -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= url("console/upgradeuser") ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar perfil de <span id="username"></span></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="user_nome">Nome</label>
                                    <input type="text" name="user_nome" class="form-control" id="user_nome">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="user_sobrenome">Sobrenome</label>
                                    <input type="text" name="user_sobrenome" class="form-control" id="user_sobrenome">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="user_email">Email</label>
                                    <input type="email" name="user_email" class="form-control" id="user_email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="user_contato">Contato (telefone)</label>
                                    <input type="text" name="user_contato" class="form-control" id="user_contato">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="user_tipo">Setor</label>
                                    <select class="form-control" type="select" name="user_tipo">
                                        <option id="user_tipo" disabled selected> </option>
                                        <?php foreach ($nl_acesso as $nl) : ?>
                                            <option value="<?= $nl->id ?>"> <?= $nl->desc_acesso ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control col-2" id="user_id" name="user_id" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar usuário</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal edit usuario -->


    <!-- Modal novo usuario -->
    <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= url("console/cria/usuario2") ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo usuário</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="inputUsername">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">Sobrenome</label>
                                    <input type="text" name="sobrenome" class="form-control" id="inputUsername">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">Email</label>
                                    <input type="email" name="email" class="form-control" id="inputUsername">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">Contato (telefone)</label>
                                    <input type="text" name="contato" class="form-control" id="inputUsername">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">Setor</label>
                                    <select class="form-control" type="select" name="tipo">
                                        <option disabled selected> Selecione um nivel </option>
                                        <?php foreach ($nl_acesso as $nl) : ?>
                                            <option value="<?= $nl->id ?>"> <?= $nl->desc_acesso ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar usuário</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- Modal novo usuario -->


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
                    $("#username").html(data.nomesobrenome);
                    $("#user_id").val(data.id);
                    $("#user_nome").val(data.nome);
                    $("#user_sobrenome").val(data.sobrenome);
                    $("#user_email").val(data.email);
                    $("#user_contato").val(data.contato);
                    $("#user_tipo").html(data.nivel);


                }, "json").fail(function() {
                    alert("Erro ao processar requisição");
                });
            });
        });
    </script>
    <?php $this->end() ?>