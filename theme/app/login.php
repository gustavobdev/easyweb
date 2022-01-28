<?php

use CoffeeCode\Router\Router;

$url = URL_BASE;
$router = new Router(URL_BASE);
$this->layout("/app/_theme2");

if(!isset($_SESSION)){
    session_start();
    if(isset($_SESSION["driver_first_name"])){
        $router->redirect("app/");
    }else{
        session_destroy();
    }
}

messagePerfil();
?>

<div class="section mt-2 text-center">
    <h1> <img src="<?= url("assets/app/assets/img/logo.png") ?>" style="width:280px" alt="logo" class="logo"></h1>
    <h4>Ganhe transportando sempre</h4>
</div>
<div class="section mb-5 p-2">

    <form method="post" action="<?= $url ?>app/login">
        <div class="card" style="background-color: #fafafa;">
            <div class=" card-body pb-1">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="email1">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Seu E-mail">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="password1">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Sua senha">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>
        </div>
</div>


<div class="form-links mt-2">
    <div>
        <a href="<?= url("app/register") ?>">Registre-se</a>
    </div>
    <div><a href="app-forgot-password.html" class="text-muted">Esqueceu a senha?</a></div>
</div>

<div class="form-button-group  transparent">
    <button type="submit" class="btn btn-primary btn-block btn-lg">Entrar</button>
</div>

</form>
</div>