<?php

use Source\Models\Candidaturas;
use Source\Models\Driver_Notifications;
use Source\Models\Frete;
use Source\Models\Motorista;

$url = URL_BASE;
if (!isset($_SESSION)) {
    session_start();
}
$aprovados = (new Candidaturas())->find("motorista = :mid and status = 2", "mid={$_SESSION["driver_id"]}")->count();
$aguardando = (new Candidaturas())->find("motorista = :mid and status = 1", "mid={$_SESSION["driver_id"]}")->count();
$publicados = (new Frete())->find("status_frete = 3")->count();
$motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");
$destinatario = (new Driver_Notifications())->find("id_driver = :idd and lida_off = 0", "idd={$_SESSION["driver_id"]}")->count();
$messages = (new Driver_Notifications())->find("id_driver = :idd", "idd={$_SESSION["driver_id"]}")->order("created_at DESC")->fetch(true);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transdoni - Mobile Template</title>
    <link rel="stylesheet" href="<?= url("assets/app/assets/css/style.css") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/logo-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo-icon.png" sizes="32x32">
    <link rel="shortcut icon" href="<?= url("assets/app/assets/img/logo-icon.png") ?>">
    <script src="<?= url("assets/app/assets/js/lib/jquery-3.4.1.min.js") ?>"></script>

</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?= url("assets/app/assets/img/logo-icon.png") ?>" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->
    <div id="messages_ajax">

    </div>

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="<?= url("assets/app/assets/img/logo-icon.png") ?>" alt="logo" class="logo">
        </div>
        <div id="notmessage" class="right">
            <a href="#" class="headerButton" <?= isset($_SESSION["em_servico"]) ? 'data-toggle="modal" data-target="#MessagesModal"' : '' ?>>
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <?php if (isset($_SESSION["em_servico"])) : ?>
                    <?php if ($destinatario > 0) : ?>
                        <span id="destinatario" class="badge badge-danger"><?= $destinatario ?></span>
                    <?php endif ?>
                <?php endif; ?>
            </a>
            <!--<a href="app-settings.html" class="headerButton">
                <img src="<?= url("assets/app/assets/img/sample/avatar/avatar1.jpg") ?>" alt="image" class="imaged w32">
                <span class="badge badge-danger">6</span>
            </a>-->
        </div>
    </div>
    <!-- * App Header -->
    <div class="modal fade modalbox" id="MessagesModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: rgba(255, 255, 255,0.7);">
                <div class="modal-header" style="background-color: rgba(255, 255, 255,0.8);">
                    <h5 class="modal-title text-center">Caixa de mensagens</h5>
                    <a href="javascript:;" data-dismiss="modal">Fechar</a>
                </div>
                <div class="modal-body">
                    <div id="msgviewer1">
                        <?php
                        if (isset($_SESSION["em_servico"])) : ?>
                            <ul class="listview image-listview flush">
                                <?php foreach ($messages as $me) : ?>
                                    <li <?= $me->lida_off === "1" ? 'class="active"' : '' ?>>
                                        <a href="#" class="item" data-val="<?= $me->msgAjax()->link ?>"  data-ids="<?= $me->id ?>"  data-lidaoff="<?= url("app/lidaoff") ?>">   
                                        <div class="icon-box bg-danger">
                                                <ion-icon name="key-outline"></ion-icon>
                                            </div>
                                            <div class="in">
                                                <div>
                                                    <div class="mb-05"><strong><?= $me->msgAjax()->title ?></strong></div>
                                                    <div class="text-small mb-05"><?= $me->msgAjax()->text ?></div>
                                                    <?php $data = new DateTime($me->created_at) ?>
                                                    <div class="text-xsmall"><?php echo $data->format("d/m/Y H:i") ?></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div id="msgviewer">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- App Capsule -->
    <div id="appCapsule">
        <?= $this->section("content") ?>
    </div>
    <!-- * App Capsule -->

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <?= $this->insert("app/fragments/footer"); ?>
    </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                            <?php if (isset($motorista->profile_photo)) : ?>
                                <img src="<?= url("{$_SESSION["profile_photo"]}") ?>" alt="<?= $_SESSION['driver_first_name'] ?>" class="imaged  w36 rounded" style="width: 80px; height: 35px; border-radius: 80px; ">
                            <?php else : ?>
                                <img src="<?= url("assets/app/assets/img/sample/avatar/avatar1.jpg") ?>" alt="avatar" class="imaged  w36">
                            <?php endif; ?>
                        </div>
                        <a href="<?= url("app/perfil") ?>">
                            <div class="in">
                                <strong><?= $_SESSION['driver_first_name'] ?></strong>
                                <div class="text-muted">ID: <?= $_SESSION['driver_id'] ?></div>
                            </div>
                        </a>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->

                    <!-- menu -->
                    <div class="listview-title mt-1">Menu</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="<?= url("app/fretes") ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="pie-chart-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Fretes Publicados
                                    <?php if (isset($_SESSION["em_servico"])) : ?>
                                        <span class="badge badge-primary"><?= $publicados ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= url("app/fretes/aprovados") ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="pie-chart-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Meus Fretes
                                    <?php if (isset($_SESSION["em_servico"])) : ?>
                                        <span class="badge badge-primary"><?= $aprovados ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= url("app/fretes/candidaturas") ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="pie-chart-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Minhas Candidaturas
                                    <?php if (isset($_SESSION["em_servico"])) : ?>
                                        <span class="badge badge-primary"><?= $aguardando ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Minhas Metas
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="apps-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Notícias
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="app-cards.html" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="card-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Extrato
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- * menu -->

                    <!-- others -->
                    <div class="listview-title mt-1">Outros</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="<?= url("app/perfil") ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="settings-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Preferências
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Suporte
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= url("app/logout") ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Sair da conta
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- * others -->

                </div>
            </div>
        </div>
    </div>
    <div id="scripttheme">

    </div>
    <!-- * App Sidebar -->
    <!-- ///////////// Js Files ////////////////////  -->

    <script>
        $(document).ready(function() {
            setInterval(function() {
                load_last_notification();
            }, 1000);

            function load_last_notification() {
                $.ajax({
                    url: "<?= url("app/search/messages") ?>",
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        if (data.output) {
                            console.log(data);
                            $('#messages_ajax').html(data.output);
                        }
                        if (data.destinatario) {
                            $('#destinatario').html(data.destinatario);

                        }
                        if (data.msg) {
                            $('#msgviewer1').html("");
                            $('#msgviewer').html(data.msg);
                        }
                        if(data.script){
                            $("#scripttheme").html(data.script);
                        }
                    }

                })
            }

            $('body').on("click", "[data-lidaoff]", function(e) {
                e.preventDefault();

                var data = $(this).data();

                $.post(data.lidaoff, data, function(data) {
                    console.log(data);
                    window.location.href= data.val;

                }, "json").fail(function(data) {
                    console.log(data);

                    alert("Erro ao processar requisição");
                });
            });
        });
    </script>
    <!-- Jquery -->
    <!-- Jquery -->
    <!-- Bootstrap-->
    <script src="<?= url("assets/app/assets/js/lib/popper.min.js") ?>"></script>
    <script src="<?= url("assets/app/assets/js/lib/bootstrap.min.js") ?>"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?= url("assets/app/assets/js/plugins/owl-carousel/owl.carousel.min.js") ?>"></script>
    <!-- Base Js File -->
    <script src="<?= url("assets/app/assets/js/base.js") ?>"></script>

</body>

</html>