<?php $this->layout("_theme2", ["title" => $title]);?>


<div class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="error-contact-wrap">
                <img src="<?=url("assets/img/404.gif")?>" alt="404">
                <h3>OOOOPS <?=$error?>, página não encontrada!</h3>
                <p>A página que você está procurando não existe.</p>
                <a href="<?=URL_BASE?>" class="default-btn btn-two">
                    Voltar à página home
                </a>
            </div>
        </div>
    </div>
</div>