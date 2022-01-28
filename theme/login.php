<?php

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["nome"])) {
    $router->redirect("console/");
}
$email = (isset($_COOKIE['CookieEmail'])) ? base64_decode($_COOKIE['CookieEmail']) : '';
$senha = (isset($_COOKIE['CookieSenha'])) ? base64_decode($_COOKIE['CookieSenha']) : '';
$lembrete = (isset($_COOKIE['CookieLembrete'])) ? base64_decode($_COOKIE['CookieLembrete']) : '';
$checked = ($lembrete == 'SIM') ? 'checked' : '';

$this->layout("_theme2", ["title" => $title]);
?>

<body>

    <div class="page-title-area item-bg-1 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6">
                        <h2>Entrar no Console</h2>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <ul>
                            <li>
                                <a href="<?= url() ?>">
                                    Home
                                </a>
                            </li>
                            <li>Entrar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="sign-up-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-action">
                        <div class="form-heading text-center">
                            <h3 class="form-title">Faça o login na sua conta!</h3>
                        </div>
                        <form method="post" action="<?=url("login") ?>">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" type="email" value="<?= $email ?>" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input id="senha" name="senha" class="form-control" type="password" value="<?= $senha ?>" placeholder="Senha">
                                        <span id="olho"><small style="color: #fa4612;">Mostrar senha</small></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 form-condition">
                                    <div class="agree-label">
                                        <input type="checkbox" name="lembrete" value="SIM" <?= $checked ?>>
                                        <label for="chb1">
                                            Lembrar-Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <a class="forget" href="#">Esqueci minha senha?</a>
                                </div>
                                <div class="col-12">
                                    <button class="default-btn btn-two" type="submit">
                                        Entrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->push("scripts") ?>

    <script type="text/javascript">
        $(document).ready(function() {
            var senha = $("#senha");
            var olho = $("#olho");

            olho.mousedown(function() {
                senha.attr("type", "text");
            });

            olho.mouseup(function() {
                senha.attr("type", "password");
            });
            // para evitar o problema de arrastar a imagem e a senha continuar exposta, 
            //citada pelo nosso amigo nos comentários

            $("#olho").mouseout(function() {
                $("#senha").attr("type", "password");
            });
        });
    </script>


    <?php $this->end(); ?>


</body>

</html>