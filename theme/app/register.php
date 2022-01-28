<?php $this->layout("/app/_theme2") ?>

<div class="section mt-2 text-center">
    <h1> <img src="<?= url("assets/app/assets/img/logo.png") ?>" style="width:280px" alt="logo" class="logo"></h1>
    <h4>Registre-se já para receber fretes </h4>
</div>
<div class=" text-center">

    <?php
    if (!isset($_SESSION)) :
        session_start();
    endif;
    if (isset($_SESSION["appreg_decline"])) :
        echo $_SESSION["appreg_decline"];
        unset($_SESSION["appreg_decline"]);
    endif;
    ?>
</div>

<div class="section mb-5 p-2">
    <form method="post" action="<?= url("app/register") ?>">
        <div class="card" style="background-color: #fafafa;">
            <div class="card-body">
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="sobrenome">Sobrenome</label>
                        <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Digite seu sobrenome">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite seu CPF somente números!">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="phone">Telefone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Digite seu Telefone/Celular somente números!">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="email1">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email1" placeholder="Seu e-mail">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password1">Senha</label>
                        <input type="password" class="form-control" name="senha" id="password1" placeholder="Sua senha">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password2">Confirmar senha</label>
                        <input type="password" class="form-control" name="confsenha" id="password2" placeholder="Digite a senha novamente">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="custom-control custom-checkbox mt-2 mb-1">
                    <input type="checkbox" class="custom-control-input" name="igree" id="customChecka1">
                    <label class="custom-control-label" for="customChecka1">
                        Eu aceito todos os <a href="#" data-toggle="modal" data-target="#termsModal">termos e condições</a>
                    </label>
                </div>

            </div>
        </div>



        <div class="form-button-group transparent">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Registrar</button>
        </div>

    </form>
</div>


<!-- ios style 12 -->
<div class="notification-box">
    <div class="notification-dialog ios-style">
        <div class="notification-header">
            <div class="in">
                <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="imaged w24 rounded">
                <strong>John Pacheco</strong>
            </div>
            <div class="right">
                <span>5 mins ago</span>
                <a href="#" class="close-button">
                    <ion-icon name="close-circle"></ion-icon>
                </a>
            </div>
        </div>
        <div class="notification-content">
            <div class="in">
                <h3 class="subtitle">Auto close in 3 seconds.</h3>
                <div class="text">
                    Lorem ipsum dolor sit amet.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * ios style 12 -->

<!-- Terms Modal -->
<div class="modal fade modalbox" id="termsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                <a href="javascript:;" data-dismiss="modal">Close</a>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fermentum, urna eget finibus
                    fermentum, velit metus maximus erat, nec sodales elit justo vitae sapien. Sed fermentum
                    varius erat, et dictum lorem. Cras pulvinar vestibulum purus sed hendrerit. Praesent et
                    auctor dolor. Ut sed ultrices justo. Fusce tortor erat, scelerisque sit amet diam rhoncus,
                    cursus dictum lorem. Ut vitae arcu egestas, congue nulla at, gravida purus.
                </p>
                <p>
                    Donec in justo urna. Fusce pretium quam sed viverra blandit. Vivamus a facilisis lectus.
                    Nunc non aliquet nulla. Aenean arcu metus, dictum tincidunt lacinia quis, efficitur vitae
                    dui. Integer id nisi sit amet leo rutrum placerat in ac tortor. Duis sed fermentum mi, ut
                    vulputate ligula.
                </p>
                <p>
                    Vivamus eget sodales elit, cursus scelerisque leo. Suspendisse lorem leo, sollicitudin
                    egestas interdum sit amet, sollicitudin tristique ex. Class aptent taciti sociosqu ad litora
                    torquent per conubia nostra, per inceptos himenaeos. Phasellus id ultricies eros. Praesent
                    vulputate interdum dapibus. Duis varius faucibus metus, eget sagittis purus consectetur in.
                    Praesent fringilla tristique sapien, et maximus tellus dapibus a. Quisque nec magna dapibus
                    sapien iaculis consectetur. Fusce in vehicula arcu. Aliquam erat volutpat. Class aptent
                    taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- * Terms Modal -->

</body>

</html>