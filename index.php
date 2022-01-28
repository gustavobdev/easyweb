<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);


//Aplicativo
$router->group("app")->namespace("Source\App\Aplicativo");
$router->get("/","App:home","App.home");
//login crud
$router->get("/login", "App:login", "App.login");
$router->post("/login", "App:loga", "App.loga");
$router->get("/register", "App:register", "App.register");
$router->post("/register", "App:registra", "App.registra");
$router->get("/logout","App:logout","App.logout");
//perfil crud
$router->get("/perfil", "App:perfil", "App.perfil");
$router->post("/perfil/save", "App:saveperfil", "App.saveperfil");
$router->post("/perfil/saveimgprofile", "App:saveimgprofile", "App.saveimgprofile");
$router->post("/perfil/ficaonline", "App:ficaonline", "App.ficaonline");
//session crud
$router->post("/verificaon", "App:verificaon", "App.verificaon");
$router->get("/editbank", "App:editbank", "App.bank");
$router->post("/editbank/save", "App:savebank", "App.savebank");
$router->post("/editcerts/save", "App:editcerts", "App.editcerts");
$router->get("/editcar", "App:editcar", "App.car");
$router->post("/editcar/save", "App:savecar", "App.savecar");
$router->get("/editreboque", "App:editreboque", "App.reboque");
$router->post("/editreboque/save", "App:savereboque", "App.savereboque");
$router->get("/editaddress", "App:editaddress", "App.address");
$router->post("/editaddress/save", "App:saveaddress", "App.saveaddress");
$router->get("/fretes", "App:fretes", "App.fretes");
$router->get("/fretes/aprovados", "App:fretes_aprovados", "App.fretes_aprovados");
$router->get("/fretes/candidaturas", "App:fretes_candidaturas", "App.fretes_candidaturas");
$router->get("/infofrete/{id}","App:infofrete","App.infofrete");
$router->post("/geraCandidatura", "App:geraCandidatura", "App.geraCandidatura");
$router->post("/selectcar", "App:selectcar", "App.selectcar");
$router->post("/selectreboque", "App:selectreboque", "App.selectreboque");
$router->post("/search/messages", "App:searchmessages", "App.searchmessages");
$router->post("/lidaoff", "App:lidaoff", "App.lidaoff");
$router->get("/notifications", "App:notifications", "App.notifications");


//Landing Page
$router->group(null)->namespace("Source\App\Landing");
$router->get("/","Web:home","Web.home");
$router->get("/login","Web:login","Admin.login");
$router->post("/login","Web:loga","Admin.loga");
$router->get("/logout","Web:logout","Admin.logout");
$router->post("/tracking", "Web:tracking");
$router->get("/rastrear/{tracking}", "Web:rastrear");
$router->post("/buscar/carro", "Web:carro");
$router->post("/dompdf", "Web:gerapdf");

$router->group("blog");
$router->get("/","Web:blog");
$router->get("/{post_uri}","Web:blog");
$router->get("/{post_uri}/{cat_uri}","Web:blog");



$router->group("contato");
$router->get("/","Web:contact");
$router->post("/","Web:contact");
$router->delete("/","Web:contact");
$router->get("/{sector}","Web:contact");
$router->get("/suporte","Web:suport");

$router->group("gera");
$router->get("/post","Web:generate_post");
$router->get("/usuario","Web:generate_user");


$router->group("admin");
$router->get("/","Admin:home");

$router->group("oops");
$router->get("/{errcode}","Web:error");

//mailer
$router->group("mailer")->namespace("Source\App\Mailer");;
$router->post("/welcome","Mailer:welcome");

//Console
$router->group("console")->namespace("Source\App\Dashboard");
$router->get("/","Admin:home","Admin.home");
//fretes
$router->get("/fretes", "Admin:frete", "Admin.frete");
$router->get("/fretespdf", "Admin:fretepdf", "Admin.fretepdf");
$router->post("/excluirpdf", "Admin:deletepdf", "Admin.deletepdf");

//multas
$router->get("/multas", "Admin:multas", "Admin.multas");
$router->post("/multas/searchcar", "Admin:searchcar", "Admin.searchcar");
$router->post("/multas/fetchdriverinfo", "Admin:fetchdriverinfo", "Admin.fetchdriverinfo");
$router->post("/multas/nova", "Admin:novaMulta", "Admin.novaMulta");
$router->post("/multas/edit", "Admin:editMulta", "Admin.editMulta");
$router->post("/multas/destroy", "Admin:destroyMulta", "Admin.destroyMulta");
$router->post("/multas/viewpdf", "Admin:viewpdf", "Admin.viewpdf");

//motoristas
$router->get("/motoristas","Admin:drivers","Admin.drivers");
$router->post("/fetch/driver","Admin:fetchDriver","Admin.fetchDriver");
$router->post("/fetch/candidato","Admin:fetchCandidato","Admin.fetchCandidato");
$router->post("/fetch/caminhao","Admin:fetchCaminhao","Admin.fetchCaminhao");
$router->get("/financeiro","Admin:builds","Admin.builds");
//users
$router->get("/members","Admin:membros","Admin.membros");
$router->post("/fetch/user","Admin:fetchUser","Admin.fetchUser");
//clientes
$router->get("/clientes","Admin:clientes","Admin.clientes");
$router->post("/fetch/cliente","Admin:fetchCliente","Admin.fetchCliente");
$router->post("/searchcte","Admin:searchCte","Admin.searchcte");

//fretes
$router->get("/fretes/{cte}","Admin:editFrete","Admin.editFrete");
$router->post("/editStatus","Admin:editStatus","Admin.editStatus");
$router->post("/fetchStatus","Admin:fetchStatus","Admin.fetchStatus");
$router->post("/editMotorista","Admin:editMotorista","Admin.Motorista");
$router->post("/editFreteCliente","Admin:editFreteCliente","Admin.editFreteCliente");
$router->post("/editOperacao","Admin:editOperacao","Admin.editOperacao");
$router->post("/editGeral","Admin:editGeral","Admin.editGeral");
$router->post("/alteraCandidatura","Admin:alteraCandidatura","Admin.alteraCandidatura");

//Docfrete
$router->post("/docfrete/upload","Admin:newDocfrete","Admin.newDocfrete");

//Criadores de Entidades
$router->get("/cria/caminhao","Admin:novoCaminhao","Admin.novoCaminhao");
$router->post("/cria/caminhao","Admin:geraCaminhao","Admin.geraCaminhao");
$router->get("/cria/cavalo","Admin:novoCavalo","Admin.novoCavalo");
$router->post("/cria/cavalo","Admin:geraCavalo","Admin.geraCavalo");
$router->get("/cria/motorista","Admin:novoMotorista","Admin.novoMotorista");
$router->post("/cria/motorista","Admin:geraMotorista","Admin.geraMotorista");
$router->post("/cria/motorista2","Admin:geraMotorista2","Admin.geraMotorista2");
$router->post("/destroy/motorista","Admin:destroyMotorista","Admin.destroyMotorista");
$router->get("/cria/usuario","Admin:novoUsuario","Admin.novoUsuario");
$router->post("/cria/usuario","Admin:geraUsuario","Admin.geraUsuario");
$router->post("/cria/usuario2","Admin:geraUsuario2","Admin.geraUsuario2");
$router->post("/destroy/usuario","Admin:destroyUsuario","Admin.destroyUsuario");
$router->get("/cria/cliente","Admin:novoCliente","Admin.novoCliente");
$router->post("/cria/cliente","Admin:geraCliente","Admin.geraCliente");
$router->post("/cria/cliente2","Admin:geraCliente2","Admin.geraCliente2");
$router->post("/destroy/cliente","Admin:destroyCliente","Admin.destroyCliente");
$router->get("/cria/frete","Admin:novoFrete","Admin.novoFrete");
$router->post("/cria/frete","Admin:geraFrete","Admin.geraFrete");


//Faturas
$router->get("/fatura","Admin:fatura","Admin.fatura");

//Edição de Projetos
$router->get("/edit/{projeto}/{id}","Admin:editPoject","Admin.editPoject");

//Edição de Contas dos Clientes
$router->get("/clientes/{cliente}/{id}", "Admin:editClient","Admin:editClient");

//Upgrade de usuarios
$router->post("/upgradeuser", "Admin:upgradeUser","Admin:upgradeUser");

//Upgrade de motoristas
$router->post("/upgradedriver", "Admin:upgradeDriver","Admin:upgradeDriver");

//Upgrade de clientes
$router->post("/upgradeclient", "Admin:upgradeClient","Admin:upgradeClient");

//Gera uma nova fatura para o cliente
$router->post("/clientes/fatura", "Admin:geraFatura","Admin:geraFatura");

//Registra a entrega de atividade em um projeto
$router->post("/projetos/entrega", "Admin:geraEntrega","Admin:geraEntrega");

$router->dispatch();

if($router->error()){
    $router->redirect("/oops/{$router->error()}");
}