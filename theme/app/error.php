<?php $this->layout("app/_theme2");
?>
<style type="text/css">
    body {
        background-color: white !important;
    }
</style>
<div class="section">
    <div class="splash-page mt-5 mb-5">
        <h1>OOPS, <?= $title ?>!</h1>
        <h2 class="mb-2">Página não encontrada!</h2>

        <img src="<?= url("assets/img/404.gif") ?>" alt="404" style="width: 300px;">
        <p>
            Que pena! a página que você tentou acesso encontra-se inativa ou não existe.
        </p>
    </div>
</div>

<div class="fixed-bar">
    <div class="row">
        <div class="col-6">
            <a href="<?= url("app/") ?>" class="btn btn-lg btn-outline-secondary btn-block goBack">Voltar ao início</a>
        </div>
        <div class="col-6">
            <a href="" onclick="window.location.reload();" class="btn btn-lg btn-primary btn-block">Tentar novamente</a>
        </div>
    </div>
</div>

</div>