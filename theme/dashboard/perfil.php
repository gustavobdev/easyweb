<?php $this->layout("dashboard/_theme");

if (!isset($_SESSION)) {
    session_start();
}
messageDash();

?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Meu Perfil</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Configurações</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                            Conta
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                            Senha
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Foto de Perfil</h5>
                            </div>
                            <form method="POST" enctype="multipart/form-data" action="<?= url("console/perfil/uploadimg") ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <?php if (isset($_SESSION["imgprofile"])) : ?>
                                                    <img alt="Charles Hall" src="<?= url("{$_SESSION["imgprofile"]}") ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                                <?php else : ?>
                                                    <img alt="Charles Hall" src="<?= url("assets/img/avatar10.jpg") ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                                <?php endif; ?>
                                                <div class="mt-2">
                                                    <label for="uploadimgs" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
                                                        <input type="file" id="uploadimgs" name="uploadimg" style="display: none;" required>
                                                </div>
                                                <small>Para melhores resultados, use uma imagem de pelo menos 128 px por 128 px no formato .jpg ou .png </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar foto</button>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Informações Pessoais</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= url("console/perfil/upgrade") ?>">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="nome">Nome</label>
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $_SESSION["user_id"] ?>" placeholder="First name">
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?= $_SESSION["nome"] ?>" placeholder="First name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="sobrenome">Sobrenome</label>
                                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?= $_SESSION["sobrenome"] ?>" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION["email"] ?>" placeholder="Email">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mudar senha</h5>

                                <form method="POST" action="<?= url("console/perfil/upgradepassword") ?>">
                                    <div class="mb-3">
                                        <label class="form-label" for="senha_atual">Senha atual</label>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $_SESSION["user_id"] ?>" placeholder="First name">
                                            <input type="password" class="form-control" name="senha_atual" id="senha_atual" placeholder="Senha atual">
                                            <button id="versenha" class="btn btn-secondary" type="button"> <i class="align-middle me-2 fas fa-fw fa-eye"></i></button>
                                        </div>
                                        <small><a href="#">Esqueceu sua senha?</a></small>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="senha_nova">Nova senha</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="senha_nova" id="senha_nova" placeholder="Senha nova">
                                            <button id="versenha1" class="btn btn-secondary" type="button"> <i class="align-middle me-2 fas fa-fw fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="repete_senha">Confirmar senha</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="repete_senha" id="repete_senha" placeholder="Senha nova">
                                            <button id="versenha2" class="btn btn-secondary" type="button"> <i class="align-middle me-2 fas fa-fw fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    $(document).ready(function() {
        $('#versenha').on('click', function() {

            var passwordField = $('#senha_atual');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType == 'password') {

                passwordField.attr('type', 'text');

                $(this).html('<i class="align-middle me-2 fas fa-fw fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');

                $(this).html('<i class="align-middle me-2 fas fa-fw fa-eye"></i>');
            }
        });
        $('#versenha1').on('click', function() {

            var passwordField = $('#senha_nova');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType == 'password') {

                passwordField.attr('type', 'text');

                $(this).html('<i class="align-middle me-2 fas fa-fw fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');

                $(this).html('<i class="align-middle me-2 fas fa-fw fa-eye"></i>');
            }
        });
        $('#versenha2').on('click', function() {

            var passwordField = $('#repete_senha');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType == 'password') {

                passwordField.attr('type', 'text');

                $(this).html('<i class="align-middle me-2 fas fa-fw fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');

                $(this).html('<i class="align-middle me-2 fas fa-fw fa-eye"></i>');
            }
        });
    });
</script>