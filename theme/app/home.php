<?php

use Source\Models\Motorista;

$router = new \CoffeeCode\Router\Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("app/login");
};

$this->layout("/app/_theme");
$motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");

?>
<!-- Wallet Card -->
<div class="section wallet-card-section ">
    <div class="wallet-card">
        <!-- Balance -->
        <div class="balance">
            <?php if (isset($motorista->profile_photo)) : ?>
                <img src="<?= url("{$_SESSION["profile_photo"]}") ?>" alt="img" class="image-block imaged " style="width:80px; height:80px; border-radius: 80px; ">

            <?php else : ?>
                <img src="<?= url("/assets/app/assets/img/sample/avatar/avatar4.jpg") ?>" alt="img" class="image-block imaged w48">
            <?php endif; ?>

            <div style="width: 100%; margin-left: 40px">
                <span class="title">Motorista</span>
                <h1 class="total"><?= $_SESSION['driver_first_name'] . " " . $_SESSION['driver_last_name']  ?></h1>
            </div>
        </div>
        <!-- * Balance -->
    </div>
</div>
<!-- Wallet Card -->

<!-- Meus Fretes -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Meus Fretes</h2>
        <a href="<?= url("app/fretes/aprovados") ?>" class="link">Ver todos</a>
    </div>
    <div class="transactions">
        <!-- item -->
        <?php
        if ($aprovados) :
            foreach ($aprovados as $aprovado) :
                if ($aprovado->motorista == $_SESSION["driver_id"]) :
        ?>
                    <a href="<?= url("app/infofrete/{$aprovado->id}") ?>" class="item">
                        <div class="detail">
                            <div>
                                <strong><?= $aprovado->origem_city()[0]->nome . " x " . $aprovado->uf_origem()[0]->uf ?></strong>
                                <p><?= $aprovado->statu()[0]->status_desc ?></p>
                                <p><?= $aprovado->fretes()[0]->obs_frete_motorista ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-success">R$ <?= $aprovado->fretes()[0]->frete_motorista ?></div>
                        </div>
                    </a>
        <?php
                endif;
            endforeach;
        else :
            echo '<a href="" class="item"><div class="detail"><strong>Sem fretes aprovados.</strong></div></a>';
        endif;
        ?>
        <!-- * item -->
    </div>
</div>
<!-- * Meus Fretes  -->

<!-- Meus Fretes -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Pendentes</h2>
        <a href="<?= url("app/fretes/candidaturas") ?>" class="link">Ver todos</a>
    </div>
    <div class="transactions">
        <!-- item -->


        <?php
        if ($candidaturas) :
            foreach ($candidaturas as $candidatura) :
                if ($candidatura->motorista == $_SESSION["driver_id"]) :
        ?>
                    <a href="<?= url("app/infofrete/{$candidatura->id}") ?>" class="item">
                        <div class="detail">
                            <div>
                                <strong><?= $candidatura->fretes()[0]->origem_cidade . " x " . $candidatura->fretes()[0]->destino_cidade ?></strong>
                                <p><?= $candidatura->statu()[0]->status_desc ?></p>
                                <p><?= $candidatura->fretes()[0]->obs_frete_motorista ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-success">R$ <?= $candidatura->fretes()[0]->frete_motorista ?></div>
                        </div>
                    </a>

        <?php
                endif;
            endforeach;
        else :

            echo '<a href="app-transaction-detail.html" class="item"><div class="detail"><strong>Sem fretes pendentes de aprovação.</strong></div></a>';
        endif;
        ?>
        <!-- * item -->
    </div>
</div>
<!-- * Meus Fretes  -->

<!--  
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Minhas Metas</h2>
        <a href="app-savings.html" class="link">Ver tudo</a>
    </div>
    <div class="goals">
        
        <div class="item">
            <div class="in">
                <div>
                    <h4>Indique um amigo</h4>
                    <p>Ganhe R$ 10 por indicação </p>
                </div>
                <div class="price">Ativo</div>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
            </div>
        </div>
      
        <div class="item">
            <div class="in">
                <div>
                    <h4>Complete 10 viagens</h4>
                    <p>Ganhe um bonus de R$ 50 </p>
                </div>
                <div class="price">Ativo</div>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">55%</div>
            </div>
        </div>
       
    </div>
</div>



<div class="section full mt-4 mb-3">
    <div class="section-heading padding">
        <h2 class="title">Notícias Transdoni</h2>
        <a href="app-blog.html" class="link">Ver Tudo</a>
    </div>
    <div class="shadowfix carousel-multiple owl-carousel owl-theme">

       
        <div class="item">
            <a href="app-blog-post.html">
                <div class="blog-card">
                    <img src="<?= url("/assets/app/assets/img/sample/photo/1.jpg") ?>" alt="image" class="imaged w-100">
                    <div class="text">
                        <h4 class="title">What will be the value of bitcoin in the next...</h4>
                        <h6>14/05/2012</h6>
                    </div>
                </div>
            </a>
        </div>
       

        
        <div class="item">
            <a href="app-blog-post.html">
                <div class="blog-card">
                    <img src="<?= url("/assets/app/assets/img/sample/photo/2.jpg") ?>" alt="image" class="imaged w-100">
                    <div class="text">
                        <h4 class="title">Rules you need to know in business</h4>
                        <h6>14/05/2012</h6>
                    </div>
                </div>
            </a>
        </div>
        

        
        <div class="item">
            <a href="app-blog-post.html">
                <div class="blog-card">
                    <img src="<?= url("/assets/app/assets/img/sample/photo/3.jpg") ?>" alt="image" class="imaged w-100">
                    <div class="text">
                        <h4 class="title">10 easy ways to save your money</h4>
                        <h6>14/05/2012</h6>
                    </div>
                </div>
            </a>
        </div>
       

        
        <div class="item">
            <a href="app-blog-post.html">
                <div class="blog-card">
                    <img src="<?= url("/assets/app/assets/img/sample/photo/4.jpg") ?>" alt="image" class="imaged w-100">
                    <div class="text">
                        <h4 class="title">Follow the financial agenda with...</h4>
                        <h6>14/05/2012</h6>
                    </div>
                </div>
            </a>
        </div>
        

    </div>
</div>
 News -->