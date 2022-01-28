<?php $this->layout("_theme2",["title" => $title]);
?>
<div class="section-title">
    <span>Lógistica</span>
    <h2 class="text-center">Acompanhe seu CTE - Nº: <?= $frete[0]->doc_viagem_cte ?></h2>
    <p>Confira abaixo a timeline do seu produto / carga.</p>
</div>

<div class="timeline">
    <?php
    if ($frete[0]->cda_terminal_coleta):
        ?>
        <div class="timeline__event  animated fadeInUp timeline__event--type1">
            <div class="timeline__event__icon ">
                <i class='bx bx-current-location' ></i>
            </div>
            <div class="timeline__event__date">
                <?= $frete[0]->cda_terminal_coleta = date("d/m/Y \- H\hi", strtotime($frete[0]->cda_terminal_coleta )); ?>
            </div>
            <div class="timeline__event__content ">
                <div class="timeline__event__title">
                    Chegada no terminal de coleta!
                </div>
                <div class="timeline__event__description">
                    <p>O motorista chegou no terminal para coletar sua encomenda!</p>
                </div>
            </div>
        </div>
    <?php
    endif;
    if ($frete[0]->sda_terminal_coleta):
        ?>
        <div class="timeline__event animated fadeInUp delay-1s timeline__event--type2">
            <div class="timeline__event__icon">
                <i class='bx bxs-been-here' ></i>
            </div>
            <div class="timeline__event__date">
                <?= $frete[0]->sda_terminal_coleta = date("d/m/Y \- H\hi", strtotime($frete[0]->sda_terminal_coleta )); ?>
            </div>
            <div class="timeline__event__content">
                <div class="timeline__event__title">
                    Saída do Terminal de Coleta
                </div>
                <div class="timeline__event__description">
                    <p>Sua encomenda encontra-se em trânsito!</p>
                </div>
            </div>
        </div>
    <?php
    endif;
    if ($frete[0]->cda_cliente):
        ?>
        <div class="timeline__event animated fadeInUp delay-2s timeline__event--type3">
            <div class="timeline__event__icon">
                <i class='bx bxs-location-plus' ></i>
            </div>
            <div class="timeline__event__date">
                <?= $frete[0]->cda_cliente = date("d/m/Y \- H\hi", strtotime($frete[0]->cda_cliente)); ?>
            </div>
            <div class="timeline__event__content">
                <div class="timeline__event__title">
                    Chegada Cliente
                </div>
                <div class="timeline__event__description">
                    <p>Sua encomenda chegou no cliente!</p>
                </div>

            </div>
        </div>
    <?php
    endif;
    if ($frete[0]->sda_cliente):
        ?>
        <div class="timeline__event animated fadeInUp delay-3s timeline__event--type4">
            <div class="timeline__event__icon">
                <i class='bx bxs-been-here' ></i>
            </div>
            <div class="timeline__event__date">
                <?= $frete[0]->sda_cliente = date("d/m/Y \- H\hi", strtotime($frete[0]->sda_cliente)); ?>

            </div>
            <div class="timeline__event__content">
                <div class="timeline__event__title">
                    Saída Cliente
                </div>
                <div class="timeline__event__description">
                    <p>Sua encomenda saiu no cliente!</p>
                </div>
            </div>
        </div>
    <?php
    endif;
    if ($frete[0]->devolucao_vazio):
    ?>
    <div class="timeline__event animated fadeInUp delay-4s timeline__event--type5">
        <div class="timeline__event__icon">
            <i class='bx bxs-been-here' ></i>
        </div>
        <div class="timeline__event__date">
            <?= $frete[0]->devolucao_vazio = date("d/m/Y \- H\hi", strtotime($frete[0]->devolucao_vazio)); ?>
        </div>
        <div class="timeline__event__content">
            <div class="timeline__event__title">
                Devolução vazio
            </div>
            <div class="timeline__event__description">
                <p>Devolução vz!</p>
            </div>
        </div>
    </div>
</div>
<?php
endif;
?>
<div class="mb-3">
    <br><br>
</div>
<style>
    * {
        box-sizing: border-box;
    }

    html {
        font-size: 14px;
    }

    .timeline {
        display: flex;
        flex-direction: column;
        margin: 20px auto;
        position: relative;
    }

    .timeline__event {
        margin-bottom: 20px;
        position: relative;
        display: flex;
        margin: 20px 0;
        border-radius: 6px;
        align-self: center;
        width: 50vw;
    }

    .timeline__event:nth-child(2n+1) {
        flex-direction: row-reverse;
    }

    .timeline__event:nth-child(2n+1) .timeline__event__date {
        border-radius: 0 6px 6px 0;
    }

    .timeline__event:nth-child(2n+1) .timeline__event__content {
        border-radius: 6px 0 0 6px;
    }

    .timeline__event:nth-child(2n+1) .timeline__event__icon:before {
        content: "";
        width: 2px;
        height: 100%;
        background: #d1211b;
        position: absolute;
        top: 0%;
        left: 50%;
        right: auto;
        z-index: -1;
        transform: translateX(-50%);
        -webkit-animation: fillTop 2s forwards 4s ease-in-out;
        animation: fillTop 2s forwards 4s ease-in-out;
    }

    .timeline__event:nth-child(2n+1) .timeline__event__icon:after {
        content: "";
        width: 100%;
        height: 2px;
        background: #d1211b;
        position: absolute;
        right: 0;
        z-index: -1;
        top: 50%;
        left: auto;
        transform: translateY(-50%);
        -webkit-animation: fillLeft 2s forwards 4s ease-in-out;
        animation: fillLeft 2s forwards 4s ease-in-out;
    }

    .timeline__event__title {
        font-size: 1.2rem;
        line-height: 1.4;
        text-transform: uppercase;
        font-weight: 600;
        color: #d1211b;
        letter-spacing: 1.5px;
    }

    .timeline__event__content {
        padding: 20px;
        box-shadow: 0 30px 60px -12px rgba(50, 50, 93, 0.25), 0 18px 36px -18px rgba(0, 0, 0, 0.3), 0 -12px 36px -8px rgba(0, 0, 0, 0.025);
        background: #fff;
        width: calc(40vw - 84px);
        border-radius: 0 6px 6px 0;
    }

    .timeline__event__date {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 600;
        background: #d1211b;
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        padding: 0 20px;
        border-radius: 6px 0 0 6px;
    }

    .timeline__event__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        padding: 20px;
        align-self: center;
        margin: 0 20px;
        background: #d1211b;
        border-radius: 100%;
        width: 40px;
        box-shadow: 0 30px 60px -12px rgba(50, 50, 93, 0.25), 0 18px 36px -18px rgba(0, 0, 0, 0.3), 0 -12px 36px -8px rgba(0, 0, 0, 0.025);
        padding: 40px;
        height: 40px;
        position: relative;
    }

    .timeline__event__icon i {
        font-size: 32px;
    }

    .timeline__event__icon:before {
        content: "";
        width: 2px;
        height: 100%;
        background: #fff;
        position: absolute;
        top: 0%;
        z-index: -1;
        left: 50%;
        transform: translateX(-50%);
        -webkit-animation: fillTop 2s forwards 4s ease-in-out;
        animation: fillTop 2s forwards 4s ease-in-out;
    }

    .timeline__event__icon:after {
        content: "";
        width: 100%;
        height: 2px;
        background: #fff;
        position: absolute;
        left: 0%;
        z-index: -1;
        top: 50%;
        transform: translateY(-50%);
        -webkit-animation: fillLeftOdd 2s forwards 4s ease-in-out;
        animation: fillLeftOdd 2s forwards 4s ease-in-out;
    }

    .timeline__event__description {
        flex-basis: 60%;
    }

    .timeline__event--type2:after {
        background: #ff7b00;
    }

    .timeline__event--type2 .timeline__event__date {
        color: #fff;
        background: #ff7b00;
    }

    .timeline__event--type2:nth-child(2n+1) .timeline__event__icon:before, .timeline__event--type2:nth-child(2n+1) .timeline__event__icon:after {
        background: #ff7b00;
    }

    .timeline__event--type2 .timeline__event__icon {
        background: #ff7b00;
        color: #fff;
    }

    .timeline__event--type2 .timeline__event__icon:before, .timeline__event--type2 .timeline__event__icon:after {
        background: #ff7b00;
    }

    .timeline__event--type2 .timeline__event__title {
        color: #ff7b00;
    }

    .timeline__event--type3:after {
        background: #ffb300;
    }

    .timeline__event--type3 .timeline__event__date {
        color: #fff;
        background-color: #ffb300;
    }

    .timeline__event--type3:nth-child(2n+1) .timeline__event__icon:before, .timeline__event--type3:nth-child(2n+1) .timeline__event__icon:after {
        background: #ffb300;
    }

    .timeline__event--type3 .timeline__event__icon {
        background: #ffb300;
        color: #fff;
    }

    .timeline__event--type3 .timeline__event__icon:before, .timeline__event--type3 .timeline__event__icon:after {
        background: #ffb300;
    }

    .timeline__event--type3 .timeline__event__title {
        color: #ffb300;
    }

    .timeline__event:last-child .timeline__event__icon:before {
        content: none;
    }

    .timeline__event--type4:after {
        background: #ffff00;
    }

    .timeline__event--type4 .timeline__event__date {
        color: #fff;
        background: #ffe600;
    }

    .timeline__event--type4:nth-child(2n+1) .timeline__event__icon:before, .timeline__event--type4:nth-child(2n+1) .timeline__event__icon:after {
        background: #ffe600;
    }

    .timeline__event--type4 .timeline__event__icon {
        background: #ffe600;
        color: #fff;
    }

    .timeline__event--type4 .timeline__event__icon:before, .timeline__event--type4 .timeline__event__icon:after {
        background: #ffe600;
    }

    .timeline__event--type4 .timeline__event__title {
        color: #ffe600;
    }

    .timeline__event--type5:after {
        background: #abd12e;
    }

    .timeline__event--type5 .timeline__event__date {
        color: #fff;
        background: #abd12e;
    }

    .timeline__event--type5:nth-child(2n+1) .timeline__event__icon:before, .timeline__event--type5:nth-child(2n+1) .timeline__event__icon:after {
        background: #abd12e;
    }

    .timeline__event--type5 .timeline__event__icon {
        background: #abd12e;
        color: #fff;
    }

    .timeline__event--type5 .timeline__event__icon:before, .timeline__event--type5 .timeline__event__icon:after {
        background: #abd12e;
    }

    .timeline__event--type5 .timeline__event__title {
        color: #abd12e;
    }

    @media (max-width: 786px) {
        .timeline__event {
            flex-direction: column;
            align-self: center;
        }

        .timeline__event__content {
            width: 100%;
        }

        .timeline__event__icon {
            border-radius: 6px 6px 0 0;
            width: 100%;
            margin: 0;
            box-shadow: none;
        }

        .timeline__event__icon:before, .timeline__event__icon:after {
            display: none;
        }

        .timeline__event__date {
            border-radius: 0;
            padding: 20px;
        }

        .timeline__event:nth-child(2n+1) {
            flex-direction: column;
            align-self: center;
        }

        .timeline__event:nth-child(2n+1) .timeline__event__date {
            border-radius: 0;
            padding: 20px;
        }

        .timeline__event:nth-child(2n+1) .timeline__event__icon {
            border-radius: 6px 6px 0 0;
            margin: 0;
        }
    }

    @-webkit-keyframes fillLeft {
        100% {
            right: 100%;
        }
    }

    @keyframes fillLeft {
        100% {
            right: 100%;
        }
    }

    @-webkit-keyframes fillTop {
        100% {
            top: 100%;
        }
    }

    @keyframes fillTop {
        100% {
            top: 100%;
        }
    }

    @-webkit-keyframes fillLeftOdd {
        100% {
            left: 100%;
        }
    }

    @keyframes fillLeftOdd {
        100% {
            left: 100%;
        }
    }
</style>
