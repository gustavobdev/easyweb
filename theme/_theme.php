<!doctype html>
<html lang="pr-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= url("assets/landing/css/bootstrap.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/owl.theme.default.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/owl.carousel.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/magnific-popup.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/animate.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/boxicons.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/flaticon.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/meanmenu.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/nice-select.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/odometer.min.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/style.css") ?>">

    <link rel="stylesheet" href="<?= url("assets/landing/css/responsive.css") ?>">

    <link rel="icon" type="image/png" href="<?= url("assets/landing/img/icon.png") ?>">

    <title><?= $this->e($title) ?> | <?= $this->e($company) ?></title>
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>


    <header class="header-area">

        <div class="top-header header-style-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header-left-content">
                            <a href="<?= url() ?>">
                                <img src="<?= url("assets/landing/img/logo/logo-one.png") ?>" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="header-right-content">
                            <ul>
                                <li>
                                    <a href="tel:+55139883240459">
                                        <i class='bx bxs-phone-call'></i>
                                        <span>Contato comercial</span>
                                        (13) 98832-4045
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bx-envelope'></i>
                                        <span>Contact support</span>
                                        <button class="btn-danger">Envie um Email</button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="prevoz-nav-style">
            <div class="navbar-area">

                <div class="mobile-nav">
                    <a href="#" class="logo">
                        <img src="<?= url("assets/landing/img/logo/logo-one.png") ?>" alt="Logo">
                    </a>
                </div>

                <div class="main-nav">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <div class="container">
                            <a class="navbar-brand" href="#">
                                <img src="<?= url("assets/landing/img/logo/logo-two.png") ?>" alt="Logo">
                            </a>
                            <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link dropdown-toggle">
                                            A Empresa
                                            <i class='bx bx-chevron-down'></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="#bio" class="nav-link">Quem somos</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#parceiros" class="nav-link">Parceiros</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#clientes" class="nav-link">Clientes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#mission" class="nav-link">Nossa Missão</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#servicos" class="nav-link">
                                            Serviços
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#rastrear" class="nav-link">
                                            Solicitar Transporte
                                        </a>

                                    </li>
                                    <li class="nav-item">
                                        <a href="#contato" class="nav-link">
                                            Fale Conosco
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= URL_BASE ?>login" target="_blank" class="nav-link dropdown-toggle">
                                            Login
                                        </a>

                                    </li>
                                </ul>

                                <div class="others-option">
                                
                                    <button type="button" class="sidebar-menu" data-bs-toggle="modal" data-bs-target="#myModal2">
                                        <i class="flaticon-menu"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </header>


    <div class="sidebar-modal">
        <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="bx bx-x"></i>
                            </span>
                        </button>
                        <h2 class="modal-title" id="myModalLabel2">
                            <a href="#">
                                <img src="<?= url("assets/landing/img/logo/logo-one.png") ?>" alt="Logo">
                            </a>
                        </h2>
                    </div>
                    <div class="modal-body">
                        <div class="sidebar-modal-widget">
                            <h3 class="title">Notícias</h3>
                            <p>Devido aos impactos causados pelo Covid-19, para sua maior segurança e de nossos
                                colaboradores,
                                estamos trabalhando em home office. Desta forma, nossos telefones do escritório estão
                                temporariamente
                                fora de uso. Caso precise entrar em contato conosco, utilize os contatos particulares de
                                nossos
                                colaboradores ou envie um e-mail através do formulário acima.</p>
                        </div>
                        <div class="sidebar-modal-widget">
                            <h3 class="title">Área do usuário</h3>
                            <ul>
                                <li>
                                    <a href="<?= URL_BASE ?>login" target="_blank">Log In</a>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-modal-widget">
                            <h3 class="title">Informações de Contato</h3>
                            <ul class="contact-info">
                                <li>
                                    <i class="bx bx-location-plus"></i>
                                    Endereço
                                    <span>RUA:. RIACHUELO , 82 , Sala 95 SANTOS-SP CEP: 11010-020</span>
                                </li>
                                <li>
                                    <i class="bx bxs-phone-call"></i>
                                    Telefones<br><br>
                                    (Gerente Comercial) Dilza Abreu <br><a href="tel:+5513988324045">(13) 98832-4045</a><br>
                                    (Gerente Financeiro) Suellen <br> <a href="tel:+5513988019495">(13) 98801-9495</a><br>
                                    (Gerente Operacional) Paulo Garcez<br> <a href="tel:+5513997275751">(13)
                                        99727-5751</a><br>
                                    (Diretor) Donizeti Silva <br> <a href="tel:+5513988442009">13988442009</a><br>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-modal-widget">
                            <h3 class="title">Conecte-se em nossas redes</h3>
                            <ul class="social-list">
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-linkedin'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-youtube'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="search-wrap">
        <div class="search">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" class="form-control" placeholder="Type Here..." />
                <button type="submit" class="default-btn">
                    Search
                </button>
            </form>
        </div>
    </div>

    <?= $this->section('content') ?>


    <footer class="footer-bottom-area fun-blue-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="single-widget-bottom">
                        <ul>
                            <li>
                                <a href="terms.html">Termos & Condições</a>
                            </li>
                            <li>
                                <a href="privacy.html">Política & Privacidade</a>
                            </li>
                            <li>
                                <a href="<?= URL_BASE ?>login" target="_blank">login</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-widget-bottom">
                        <small><b>
                                <a style="color: white"> Copyright <i class="bx bx-copyright"></i> 2021 Transdoni.
                                    Desenvolvido por</a>
                                <a style="color: red" href="https://softgbs.com.br/" target="_blank">GBS Soluções em TI</a>
                            </b></small>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-widget-bottom">
                        <ul class="social-link">
                            <li>
                                <a href="#">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-linkedin'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-youtube'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <div class="go-top">
        <i class='bx bx-chevrons-up bx-fade-up'></i>
        <i class='bx bx-chevrons-up bx-fade-up'></i>
    </div>
    <style>
        #imagem_whats {
            position: fixed;
            right: 0;
            bottom: 0;
            width: 70px;
            display: block;
            cursor: pointer;
            z-index: 9999999;
            float: right
        }

        #imagem_whats2 {
            position: fixed;
            right: 0;
            bottom: 0;
            display: block;
            width: 60px;
            cursor: pointer;
            z-index: 9999999;
            float: right;
            display: none
        }

        @media only screen and (max-width: 999px) and (min-width: 100px) {
            #imagem_whats {
                display: none
            }

            #imagem_whats2 {
                display: block
            }
        }
    </style>
    <img id="imagem_whats" src="<?=url("assets/img/whatss.gif")?>" onClick="window.open('https://web.whatsapp.com/send?phone=+556200000000&amp;text=Olá!', '_blank');">
    <img id="imagem_whats2" src="<?=url("assets/img/whatss.gif")?>" onClick="window.open('https://api.whatsapp.com/send?phone=+556200000000&amp;text=Olá!', '_blank');">
    <div class="preloader">
        <div class="preloaderimg"></div>
    </div>
    <script src="<?= url("assets/js/sweetalert.js") ?>"></script>
    <script src="<?= url("assets/landing/js/jquery.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/meanmenu.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/wow.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/owl.carousel.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/magnific-popup.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/nice-select.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/appear.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/odometer.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/jarallax.min.js") ?>"></script>
    <script src="<?= url("assets/landing/js/ajaxchimp.min.js") ?>"></script>
    <script src="<?= url("/assets/landing/js/custom.js") ?>"></script>
    <?php
    messageTracking();

    ?>
    <?= $this->section('scripts') ?>



</body>

</html>