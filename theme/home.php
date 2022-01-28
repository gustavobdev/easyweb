<?php $this->layout("_theme", ["title" => $title]);
 ?>

<section class="prevoz-slider-area prevoz-slider-area-two">
    <div class="prevoz-slider owl-carousel owl-theme">
        <div class="prevoz-slider-item slider-item-bg-4">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="prevoz-slider-text overflow-hidden one">
                            <span>Transporte e Logística</span>
                            <h1>TRANSDONI</h1>
                            <p>Transporte e Agenciamento de cargas.</p>
                            <div class="tracking-body">
                                <form action="<?=URL_BASE?>tracking" method="post" class="tracking-wrap">
                                    <input type="text" class="input-tracking"
                                           placeholder="Digite seu número de rastreamento"
                                           name="tracking"/>
                                    <button class="default-btn active" type="submit" value="submit">Rastrear agora
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="prevoz-slider-item slider-item-bg-5">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="prevoz-slider-text overflow-hidden two">
                            <h1>Entregamos em todo território nacional</h1>
                            <p>Se qualidade e eficiência são importantes para sua remessa, experimente nossos serviços.</p>
                            <div class="tracking-body">
                                <form action="<?=URL_BASE?>tracking" method="post" class="tracking-wrap">
                                    <input type="text" class="input-tracking"
                                           placeholder="Digite seu número de rastreamento"
                                           name="tracking"/>
                                    <button class="default-btn active" type="submit" value="submit">Rastrear agora
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="prevoz-slider-item slider-item-bg-6">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="prevoz-slider-text overflow-hidden three">

                            <h1>Entregas seguras de cargas</h1>
                            <p>Com a Transdoni sua entrega é feita de forma segura e simples, tudo para oferecer o melhor serviço de transporte para você.</p>
                            <div class="tracking-body">
                                <form action="<?=URL_BASE?>tracking" method="post" class="tracking-wrap">
                                    <input type="text" class="input-tracking"
                                           placeholder="Digite seu número de rastreamento"
                                           name="tracking"/>
                                    <button class="default-btn active" type="submit" value="submit">Rastrear agora
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="what-offer-area-two mt-minus-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="single-offer">
                    <i class="icon flaticon-server"></i>
                    <h3>Transporte Terrestre</h3>
                    <p>Transportes rodoviários de carga em geral (contêineres e carga solta);<br>
                        Importação / Exportação– DI / DTA – LCL –FCL;<br>
                        Transportes Produtos Químicos, não controlados pela ONU;</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="single-offer">
                    <i class="icon flaticon-plastic-bottle"></i>
                    <h3>Armazém Gerais</h3>
                    <p>Armazenagem / Ova e Desova /Pré-Stacking;<br>
                        Consolidação de Cargas de exportação –REDEX;<br>
                        Armazenamento e Consolidação de cargasimportação;</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="single-offer">
                    <i class="icon flaticon-air-freight"></i>
                    <h3>Transporte aéreo</h3>
                    <p>Transportes rodoviários de cargas em aeroportos (VCP eGRU);<br>
                        Importação /Exportação;</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 p-0" id="bio">
                <div class="single-offer">
                    <i class="icon flaticon-street"></i>
                    <h3>Serviços de Container</h3>
                    <p>Armazenagem de Contêineres cheios;<br>
                        Crossdoking;<br>
                        Pré-Stacking;<br>
                        Handling.</p>
                </div>
            </div>
        </div>
    </div>

</section>


<section class="about-area about-area-two pb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-content">
                    <span>Sobre a Empresa</span>
                    <h2>A Transdoni</h2>
                    <p>Com intuito de inovar as soluções logísticas no Porto de Santos, A Transdoni foi fundada por
                        especialistas em logística, alguns com mais de 20 anos de atividade, para atender essa demanda
                        do mercado de transportes. E a inovação chegou com a experiência de profissionais e uma política
                        de trabalho bem definida, estruturada por técnicos em transportes de logística.</p>

                </div>
            </div>
            <div class="col-lg-6 pr-0">
                <div class="about-img">
                    <div class="about-list">
                        <ul>
                            <li>
                                <p>O excelente atendimento da Transdoni se destaca pelo diferencial em serviços
                                    personalizados, por sua metodologia de trabalho, tratando cada um dos clientes e
                                    parceiros comerciais como únicos.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="tracking-number-area tracking-number-area-seven bg-f7f7f7 pb-70 pt-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="tracking-content">
                    <h2>Use este formulário para rastrear seu pedido manualmente</h2>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="tracking-body">
                    <form action="<?=URL_BASE?>tracking" method="post" class="tracking-wrap">
                        <input type="text" class="input-tracking"
                               placeholder="Digite seu número de rastreamento"
                               name="tracking"/>
                        <button class="default-btn active" type="submit" value="submit">Rastrear agora
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="brand-area brand-area-two pt-70 pb-70" id="parceiros">
    <div class="section-title text-center">
        <span>Quem confia no nosso trabalho </span>
        <h2>Nossos Parceiros</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="brand-wrap owl-carousel owl-theme">
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/6.png")?>" alt="Image">
                    </a>
                    <a class="brand-overly" href="#">
                        <img src="<?= url("assets/landing/img/brand/white-6.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/7.png")?>" alt="Image">
                    </a>
                    <a class="brand-overly" href="#">
                        <img src="<?= url("assets/landing/img/brand/white-7.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/8.png")?>" alt="Image">
                    </a>
                    <a class="brand-overly" href="#">
                        <img src="<?= url("assets/landing/img/brand/white-8.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/9.png")?>" alt="Image">
                    </a>
                    <a class="brand-overly" href="#">
                        <img src="<?= url("assets/landing/img/brand/white-9.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/10.png")?>" alt="Image">
                    </a>
                    <a class="brand-overly" href="#">
                        <img src="<?= url("assets/landing/img/brand/white-10.png")?>" alt="Image">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="counter-area counter-area-two pt-100 pb-30 jarallax" data-jarallax='{"speed": 0.3}' id="clientes">

    <div class="container">

        <h5 style="color: white">Quem já trabalha conosco</h5>

        <div class="row">

            <div class="brand-wrap owl-carousel owl-theme">
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/1.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/2.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/3.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/4.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/5.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/06.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/07.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/08.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/09.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/010.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/11.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/12.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/13.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/14.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/15.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/16.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/17.png")?>" alt="Image">
                    </a>
                </div>
                <div class="brand-item">
                    <a href="#">
                        <img src="<?= url("assets/landing/img/brand/18.png")?>" alt="Image">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<br>

<br><br>
<section class="choose-us-area" id="mission">
    <div class="container">
        <div class="section-title">
            <span>Qualidade e excelência</span>
            <h2>Por que nos escolher?</h2>
        </div>
        <div class="">
            <p>Hoje a transdoni é referência em logística e comércio exterior. Especializada no segmento de transporte
                multimodal e por isso ,
                está preparada para atender todas as exigências desse mercado, sempre com pontualidade, agilidade e
                segurança.</p>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-8 pr-0">
                <div class="choose-tab-wrap">
                    <h2>Conheça mais sobre nós</h2>
                    <div class="tab quote-list-tab choose-tab">
                        <ul class="tabs">
                            <li>
                                <a href="#">
                                    Missão
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Visão
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Valores
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Política de Qualidade
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Atendimento
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Meio Ambiente
                                </a>
                            </li>
                        </ul>
                        <div class="tab_content">
                            <div class="tabs_item">

                                <p> Prestar atendimento sempre com qualidade e respeito ao meio ambiente;</p>
                                <p>Agir de forma transparente em todas as atividades comerciais;</p>
                                <p>Superar as expectativas dos clientes em serviços de logísticas;</p>
                                <p>Buscar melhorias contínua para chegar ao mais alto grau de excelência.</p>
                            </div>
                            <div class="tabs_item">
                                <p>Continuar sendo referencia em logística e transporte rodoviário de Cargas nos Portos,
                                    destacando-se pela qualidade dos serviços prestados, buscando continuamente
                                    inovações
                                    e melhores resultados.</p>
                            </div>
                            <div class="tabs_item">
                                <p>Qualidade;</p>
                                <p>Segurança;</p>
                                <p>Comprometimento;</p>
                                <p>Pontualidade;</p>
                                <p>Respeito;</p>
                                <p>Transparência;</p>
                                <p>Ética;</p>
                            </div>
                            <div class="tabs_item">
                                <p>Dispomos da experiência de nossos gestores e colaboradores com capacitação e dinâmica
                                    integrada baseadas nos conceitos do sistema de qualidade praticados no mercado de
                                    acordo com o nosso ramo de atuação buscando proporcionar satisfação dos nossos
                                    clientes,
                                    colaboradores e parceiros comerciais.</p>
                            </div>
                            <div class="tabs_item">
                                <p>Gerenciamos o fluxo dos transportes de cargas e logística, com experiência e
                                    tecnologia
                                    no Porto de Santos e nos Aeroportos de Viracopos e Guarulhos. Atendemos todo o
                                    Brasil
                                    no segmento de cargas inteiras e fracionadas.</p>
                            </div>
                            <div class="tabs_item">
                                <p>Adotamos medidas de conscientização e preservação do meio ambiente, através do
                                    cumprimento permanente das exigências legais aplicáveis.
                                    <br>
                                    Como Filosofia constante a inovação, alinhando a busca de melhorias continuas,
                                    visando a redução do impacto de suas atividades sobre recursos naturais e
                                    preservando o meio ambiente.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pl-0">
                <div class="choose-img choose-img-two">
                </div>
            </div>
        </div>
    </div>
</section>

<br><br>

<section class="began-area began-area-three began-area-four">
    <div class="container-fluid p-0">
        <div class="began-top-wrap">
            <div class="row">
                <div class="col-lg-5 pr-0">
                    <div class="begans-bg">
                    </div>
                </div>
                <div class="col-lg-7 pl-0">
                    <div class="began-wrap">
                        <h2>Certificados</h2>
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 p-0">
                                <div class="single-began">
                                    <img src="<?= url("assets/landing/img/certificates/anvisa.png")?>" alt="Image"/>
                                    <h3>Anvisa</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 p-0">
                                <div class="single-began">
                                    <img src="<?= url("assets/landing/img/certificates/cargas-perigosas.png")?>" alt="Cargas Perigosas"/>
                                    <h3>Cargas Perigosas</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 p-0">
                                <div class="single-began">
                                    <img src="<?= url("assets/landing/img/certificates/Exercito.png")?>" alt="Exército"/>
                                    <h3>Exército</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 p-0">
                                <div class="single-began">
                                    <img src="<?= url("assets/landing/img/certificates/ibama.png")?>" alt="Ibama"/>
                                    <h3>Ibama</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 p-0">
                                <div class="single-began">
                                    <img src="<?= url("assets/landing/img/certificates/policia-civil.png")?>" alt="Polícia Civil"/>
                                    <h3>Polícia Civil</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 p-0">
                                <div class="single-began">
                                    <img src="<?= url("assets/landing/img/certificates/policia-federal.png")?>" alt="Polícia Federal"/>
                                    <h3>Polícia Federal</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-project-area pb-100" id="servicos">
    <div class="container-fluid p-0">
        <div class="section-title">
            <span>Nossos Serviços</span>
            <h2>Serviços Prestados</h2>
            <p>Confira abaixo os nossos serviços prestados e Seguros.</p>
        </div>
        <div class="project-main-wrap owl-carousel owl-theme">
            <div class="single-project">
                <img src="<?= url("assets/landing/img/project/1.jpg")?>" alt="Image">
                <div class="project-content">
                    <div class="project-content-wrap">
                        <h3>Transporte Terrestre</h3>
                        <p>Transportes rodoviários de carga em geral (contêineres e carga solta);<br>
                            Importação / Exportação– DI / DTA – LCL –FCL;<br>
                            Transportes Produtos Químicos, não controlados pela ONU;</p>
                    </div>
                </div>
            </div>
            <div class="single-project">
                <img src="<?= url("assets/landing/img/project/2.jpg")?>" alt="Image">
                <div class="project-content">
                    <div class="project-content-wrap">
                        <h3>Armazém Gerais</h3>
                        <p>Armazenagem / Ova e Desova /Pré-Stacking;<br>
                            Consolidação de Cargas de exportação –REDEX;<br>
                            Armazenamento e Consolidação de cargasimportação;</p>
                    </div>
                </div>
            </div>
            <div class="single-project">
                <img src="<?= url("assets/landing/img/project/3.jpg")?>" alt="Image">
                <div class="project-content">
                    <div class="project-content-wrap">
                        <h3>Transporte aéreo</h3>
                        <p>Transportes rodoviários de cargas em aeroportos (VCP eGRU);<br>
                            Importação /Exportação;</p>
                    </div>
                </div>
            </div>
            <div class="single-project">
                <img src="<?= url("assets/landing/img/project/04.jpg")?>" alt="Image">
                <div class="project-content">
                    <div class="project-content-wrap">
                        <h2> Seguros </h2>
                        <h3>CARGAS GERAIS (NACIONALIZADAS)</h3>
                        <p>RCTR-C e RCF-DC:<br>
                            N° Apólice: 0054|250|6064|0013346|01 = valor cobertura até R$1 milhão por transportes, acima
                            com autorização esporádico em 24 horas antecedência;</p>
                    </div>
                </div>
            </div>
            <div class="single-project">
                <img src="<?= url("assets/landing/img/project/05.jpg")?>" alt="Image">
                <div class="project-content">
                    <div class="project-content-wrap">
                        <h2> Seguros </h2>
                        <h3>CARGAS EM DTA (TRÂNSITO ADUANEIRO)</h3>
                        <p>RCTR-C e RCF-DC:<br>
                            DTA- Seguro Gantia:<br>
                            N°Apólice: 0775.22.1.126.1 e 128-8 = valor cobertura total de até R$1,7 milhões por
                            transportes;</p>
                    </div>
                </div>
            </div>
            <div class="single-project">
                <img src="<?= url("assets/landing/img/project/06.jpg")?>" alt="Image">
                <div class="project-content">
                    <div class="project-content-wrap">
                        <h2> Seguros </h2>
                        <h3>GERENCIAMENTO DE RISCO</h3>
                        <p>Gerenciadora de Risco BUONNY:<br>
                            DTA- Seguro Gantia:<br>
                            Contrato fixo com a Buonny efetuando todos os cadastros e consultas dos nossos motoristas;
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="subscribe-area ptb-100">
    <div class="container">
        <div class="section-title white-title">
            <h2> Se inscreva para receber novidades</h2>
        </div>
        <div class="tracking-body">
            <form class="tracking-wrap newsletter-form" data-toggle="validator">
                <input type="email" class="input-tracking" placeholder="Seu Email" name="EMAIL" required
                       autocomplete="off">
                <button class="default-btn active" type="submit">
                    Inscrever-se
                </button>
                <div id="validator-newsletter" class="form-result"></div>
            </form>
        </div>
    </div>
</div>


<section class="track-area track-area-two pt-100" id="rastrear">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tab quote-list-tab">
                    <ul class="tabs">
                        <li>
                            <a href="#">
                                <i class="flaticon-truck"></i>
                                Solicitar Transporte
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Fazer Cotação
                                <i class="flaticon-quote"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab_content">
                        <div class="tabs_item mb-minus-70">
                            <form>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <h3>Dados Pessoais</h3>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Nome*">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Email*">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Telefone*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h3>Dados de Remessa</h3>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="form-group">
                                                    <select>
                                                        <option value="1">Type of flight One</option>
                                                        <option value="2">Type of flight Two</option>
                                                        <option value="0">Type of flight Three</option>
                                                        <option value="3">Type of flight Four</option>
                                                        <option value="4">Type of flight Five</option>
                                                        <option value="5">Type of flight Six</option>
                                                        <option value="6">Type of flight Seven</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Cidade de partida">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Destino Final">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="form-group">
                                                    <select>
                                                        <option value="1">Carga Solta</option>
                                                        <option value="2">Container 20</option>
                                                        <option value="0">Container 40</option>
                                                        <option value="3">Excedente</option>
                                                        <option value="4">Outros</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Width">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Height">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Width">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Length">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Entrega Expressa
                                                    <input type="radio" checked="checked" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Carga Marítima
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Carga Terrestre
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Carga Aérea
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="default-btn">
                                                    Solicitar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="track-img"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tabs_item">
                            <form>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <h3>Shipment Type</h3>
                                                <div class="form-group">
                                                    <select>
                                                        <option value="1">Property Used For</option>
                                                        <option value="2">Home Insurance</option>
                                                        <option value="0">Business Insurance</option>
                                                        <option value="3">Health Insurance</option>
                                                        <option value="4">Travel Insurance</option>
                                                        <option value="5">Car Insurance</option>
                                                        <option value="6">Life Insurance</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-30">
                                                <h3>Tracking Number</h3>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control"
                                                              placeholder="You can enter up to a maximum of 10 airway bill numbers for tracking."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Express Delivery
                                                    <input type="radio" checked="checked" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Ocean Freight
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Road Freight
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-md-3">
                                                <label class="single-check">
                                                    Air Freight
                                                    <input type="radio" name="radio">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <button type="submit" class="default-btn mt-30">
                                                Enviar Mensagem
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="track-img"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br><br>
<section class="address-area pt-100 pb-70" id="contato">
    <div class="container">
        <div class="section-title">
            <span>Tire suas dúvidas conosco</span>
            <h2>Entre em Contato</h2>
            <p>Veja nossa localização no mapa, endereços e informações de contato.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-address">
                    <i class='bx bx-location-plus'></i>
                    <h3>Endereço</h3>
                    <span>Descubra onde estamos</span>
                    <p>RUA:. RIACHUELO , 82 , Sala 95 SANTOS-SP CEP: 11010-020</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-address">
                    <i class='bx bx-phone-call'></i>
                    <h3>Telefones</h3><br>

                    <h6>(Gerente Comercial) Dilza Abreu</h6><a href="tel:+5513988324045">(13) 98832-4045</a><br>
                    <h6>(Gerente Financeiro) Suellen </h6> <a href="tel:+5513988019495">(13) 98801-9495</a><br>
                    <h6>(Gerente Operacional) Paulo Garcez</h6>> <a href="tel:+5513997275751">(13) 99727-5751</a><br>
                    <h6> (Diretor) Donizeti Silva </h6>  <a href="tel:+5513988442009">13988442009</a><br>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                <div class="single-address">
                    <i class='bx bx-time'></i>
                    <h3>Agende uma visita</h3><br>
                    <h6>Horário de Atendimento:</h6>
                    <small>Devido a pandemia estamos atendendo em home office.</small>
                </div>
            </div>
        </div>
    </div>

    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe width="100%" height="700" id="gmap_canvas"
                    src="https://maps.google.com/maps?q=RUA:.%20RIACHUELO%20,%2082&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
    </div>
</section>


<section class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-wrap contact-pages mb-0">
                    <div class="contact-form">
                        <div class="section-title">
                            <span class="pumpkin-color">informação</span>
                            <h2>Deixe-nos uma mensagem para qualquer dúvida</h2>
                        </div>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" required data-error="Por favor, digite seu nome" placeholder="Your Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Por favor, digite seu email" placeholder="Your Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="phone_number" id="phone_number" required data-error="Por favor, digite seu número" class="form-control" placeholder="Your Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Por favor, digite o assunto" placeholder="Your Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" required data-error="Digite sua menssagem" placeholder="Your Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-two">
                                        Enviar Mensagem
                                    </button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

