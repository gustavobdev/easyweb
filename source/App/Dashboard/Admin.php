<?php


namespace Source\App\Dashboard;

use CoffeeCode\DataLayer\Connect;
use DateTime;
use League\Plates\Engine;
use Source\Models\Anuncios;
use Source\Models\Banco;
use Source\Models\Relacao_Caminhao;
use Source\Models\Build_status;
use Source\Models\Builds;
use Source\Models\Caminhao;
use Source\Models\Candidaturas;
use Source\Models\Cliente;
use Source\Models\Clients;
use Source\Models\Cidades;
use Source\Models\Credentials;
use Source\Models\Docfrete;
use Source\Models\Pdf_Frete;
use Source\Models\Drivers;
use Source\Models\Entregas;
use Source\Models\Fornecedores;
use Source\Models\Frete;
use Source\Models\Log_Fretes;
use Source\Models\Motorista;
use Source\Models\Multas;
use Source\Models\Nl_Acesso;
use Source\Models\Projetcs;
use Source\Models\Reboque;
use Source\Models\Relacao_Reboque;
use Source\Models\Status_candidatura;
use Source\Models\Status_conta;
use Source\Models\Status_frete;
use Source\Models\Uf;
use Source\Models\User;

class Admin
{
    protected Engine $view;

    public function __construct()
    {


        $this->view = new Engine(__DIR__ . "/../../../theme");
    }

    public function home()
    {
        $fretes = (new Frete())->find()->count(); //total fretes
        $fretess = (new Frete())->find()->order("created_at DESC")->limit(5)->fetch(true); // ultimos 5 adicionados
        $semcte = (new Frete())->find("doc_viagem_cte IS NULL")->count(); //pendentes de CTE
        $semmot =  (new Frete())->find("motorista is null")->count(); //sem motorista
        $emop = (new Frete())->find("status_frete = :sta", "sta=2")->count();
        $emtransp = (new Frete())->find("status_frete = :sta", "sta=5")->count();
        $faturados = (new Frete())->find("data_saldo IS NOT NULL")->count();
        $Date = date('m-d-Y');
        $sfr = "6";
        $finalizados = (new Frete())->find("status_frete = :sfr", "sfr={$sfr}")->count();

        echo $this->view->render("/dashboard/home", [
            "title" => "Home |Gbs",
            "frete" => $fretes,
            "secte" => $semcte,
            "fretes" => $fretess,
            "semmot" => $semmot,
            "emop" => $emop,
            "emtransp" => $emtransp,
            "faturados" => $faturados,
            "finalizados" => $finalizados,
            "date" => $Date
        ]);
    }
    public function frete()
    {
        $fretes = (new Frete())->find()->fetch(true);
        echo $this->view->render("/dashboard/fretes", [
            "title" => "Home |Gbs",
            "fretes" => $fretes
        ]);
    }

    //multas
    public function multas()
    {

        $dt_atual        = date("Y-m-d"); // data atual
        $date = date("Y-m-01");
        $fndate = date("Y-m-t", strtotime($date));
        $vencidas =  (new Multas())->find("data_vencto < :dtv and data_pagto is null", "dtv={$dt_atual}")->count();
        $pendentes =  (new Multas())->find("data_pagto is null")->count();
        $pagas =  (new Multas())->find("data_pagto is not null")->count();
        $totaldodia =  (new Multas())->find("data_pagto = :dpg", "dpg={$dt_atual}")->fetch(true);
        $multasdia =  (new Multas())->find("DATE(created_at) = :cre", "cre={$dt_atual}")->count();
        $multasmes = (new Multas())->find("created_at between :dt1 and :dt2", "dt1={$date}&dt2={$fndate}")->count();
        $mensais = (new Multas())->find("data_pagto between :dt1 and :dt2", "dt1={$date}&dt2={$fndate}")->fetch(true);
        $multas = (new Multas())->find()->fetch(true);
        $drivers = (new Motorista())->find("interno = 1")->fetch(true);
        echo $this->view->render("/dashboard/multas", [
            "drivers" => $drivers,
            "multas" => $multas,
            "vencidas" => $vencidas,
            "pendentes" => $pendentes,
            "pagas" => $pagas,
            "totaldodia" => $totaldodia,
            "mensais" => $mensais,
            "multasdia" => $multasdia,
            "multasmes" => $multasmes
        ]);
    }
    public function fetchdriverinfo($data)
    {

        if (isset($data["motorista_id"])) {
            $driver = (new Motorista())->findById("{$data["motorista_id"]}");
            if ($driver) {

                $data_cnh = new DateTime($driver->validade_cnh);
                echo json_encode(array(

                    "drivernamee" => $driver->nome . "-" . $driver->sobrenome,
                    "drivername" => $driver->nome . " " . $driver->sobrenome,
                    "cnh" => $driver->cnh,
                    "validadecnh" => $data_cnh->format("d/m/Y")
                ));
            }
        }
    }
    public function editMulta($data)
    {

        if (isset($data["id"])) {

            $multas = (new Multas())->findById("{$data["id"]}");

            if (isset($multas)) {

                $validade_cnh = new DateTime($multas->motorista()->validade_cnh);
                $data_vencto = new DateTime($multas->data_vencto);

                if ($multas->caminhao()) {
                    $validade_renavam = new DateTime($multas->caminhao()[0]->validade_renavam);
                    $placa = $multas->caminhao()[0]->placa_caminhao;
                    $renavam = $multas->caminhao()[0]->renavam_caminhao;
                    $modelo =  $multas->caminhao()[0]->modelo;
                }
                if ($multas->reboque()) {
                    $validade_renavam = new DateTime($multas->reboque()[0]->validade_renavam);
                    $placa = $multas->reboque()[0]->placa_reboque;
                    $renavam = $multas->reboque()[0]->renavam_reboque;
                    $modelo =  "Reboque";
                }
                if ($multas->data_pagto) {
                    $data_pagto = new DateTime($multas->data_pagto);
                }

                echo json_encode(array(
                    "id" => $multas->id,
                    "placa" => $placa,
                    "renavam" => $renavam,
                    "validaderena" => $validade_renavam->format("d/m/Y"),
                    "modelo" => $modelo,
                    "drivername" => $multas->motorista()->nome . " " . $multas->motorista()->sobrenome,
                    "drivercnh" => $multas->motorista()->cnh,
                    "validadecnh" => $validade_cnh->format("d/m/Y"),
                    "numerodoc" => $multas->numero_doc,
                    "vencto" => $multas->data_vencto ? $multas->data_vencto : '',
                    "pagto" => $multas->data_pagto ? $multas->data_pagto : '',
                    "valordoc" => $multas->valor,
                    "obsmulta" => $multas->obs
                ));
            }
        }
    }
    public function novaMulta($data)
    {

        echo $this->view->render("/fragments/geradores/novamulta", [
            "data" => $data
        ]);
    }
    public function viewpdf($data)
    {
        if (isset($data["id"])) {
            $multas = (new Multas())->findById("{$data["id"]}");
            if ($multas) {
                echo json_encode(array(
                    "pdf" => "<embed src=\"" . URL_BASE . $multas->doc . "\" frameborder=\"0\" width=\"100%\" height=\"400px\">"
                ));
            }
        }
    }

    public function destroyMulta($data)
    {
        echo $this->view->render("/fragments/geradores/destroymulta", [
            "data" => $data,
        ]);
    }

    public function searchcar($data)
    {

        if (isset($data["car"])) {

            $caminhao = (new Caminhao())->find("renavam_caminhao = :ren or placa_caminhao = :pla and interno = 1", "ren={$data["car"]}&pla={$data["car"]}")->fetch(true);
            $reboque = (new Reboque())->find("renavam_reboque = :ren or placa_reboque = :pla and interno = 1", "ren={$data["car"]}&pla={$data["car"]}")->fetch(true);

            if (isset($caminhao)) {
                $validade_renavam = new DateTime($caminhao[0]->validade_renavam);
                echo json_encode(array(
                    "caminhao" => true,
                    "id" => $caminhao[0]->id,
                    "placa" => $caminhao[0]->placa_caminhao,
                    "renavam" => $caminhao[0]->renavam_caminhao,
                    "renavamm" => $caminhao[0]->renavam_caminhao,
                    "validaderena" => $validade_renavam->format("d/m/Y"),
                    "modelo" => $caminhao[0]->modelo

                ));
            } elseif (isset($reboque)) {

                $validade_renavam = new DateTime($reboque[0]->validade_renavam);
                echo json_encode(array(
                    "reboque" => true,
                    "id" => $reboque[0]->id,
                    "placa" => $reboque[0]->placa_reboque,
                    "renavam" => $reboque[0]->renavam_reboque,
                    "renavamm" => $reboque[0]->renavam_reboque,
                    "validaderena" => $validade_renavam->format("d/m/Y")

                ));
            } else {

                echo json_encode(array(
                    "icon" => "error",
                    "title" => "OOPS!",
                    "text" => "Veículo não encontrado!"
                ));
            }
        }
    }

    public function fetchStatus($data)
    {

        $frete = (new Frete())->findById("{$data["freteid"]}");

        if (isset($frete)) {

            if (!isset($_SESSION)) {
                session_start();
            }

            if ($_SESSION["nl_acesso"] === "1") {
                $nl_acesso = "1";
            } else {
                $nl_acesso = null;
            }

            echo json_encode(array(
                "id" => $frete->id,
                "idstatus" => $frete->status_frete,
                "nlacesso" => $nl_acesso
            ));
        }
    }
    public function fretepdf()
    {
        $docfretes = (new Pdf_Frete())->find()->fetch(true);

        echo $this->view->render("/dashboard/fretepdf", [
            "title" => "Home |Gbs",
            "docfretes" => $docfretes
        ]);
    }
    public function deletepdf($data)
    {
        echo $this->view->render("/fragments/frete/excluipdf", [
            "title" => "Home |Gbs",
            "data" => $data
        ]);
    }
    public function searchCte($data)
    {

        $cte = (new Frete())->find("doc_viagem_cte = :doc or id = :idc", "doc={$data["cte"]}&idc={$data["cte"]}")->fetch(true);

        if ($cte) {
            $created_at = new DateTime($cte[0]->created_at);

            if ($cte[0]->origem_city()) :
                $origem =  $cte[0]->origem_city()[0]->nome . " / ";
            else :
                $origem = "Vazio / ";
            endif;

            if ($cte[0]->uf_origem()) :
                $origem_uf = $cte[0]->uf_origem()[0]->uf . " => ";
            else :
                $origem_uf =  "Vazio => ";
            endif;

            if ($cte[0]->destino_city()) :
                $destino_city = $cte[0]->destino_city()[0]->nome . " / ";
            else :
                $destino_city = "Vazio / ";
            endif;

            if ($cte[0]->destin_uf()) :
                $destino_uf = $cte[0]->destin_uf()[0]->uf;
            else :
                $destino_uf = "Vazio";
            endif;
            if ($cte[0]->clientes()) :
                $cliente = $cte[0]->clientes()[0]->razao_social;
            else :
                $cliente = "Sem cliente";
            endif;
            if ($cte[0]->motoristas()) :
                $motorista = $cte[0]->motoristas()[0]->nome . " " . $cte[0]->motoristas()[0]->sobrenome;
            else :
                $motorista = "Sem motorista";
            endif;

            echo json_encode(array(
                "temcte" => "true",
                "idcte" => $cte[0]->id . " / " . $cte[0]->doc_viagem_cte,
                "criacao" => $created_at->format("d/m/Y H:i:s"),
                "origemdestino" => $origem . $origem_uf . $destino_city . $destino_uf,
                "cliente" => $cliente,
                "statusfr" => $cte[0]->status_fretes()[0]->status_desc,
                "motorista" => $motorista,
                "faturado" => $cte[0]->n_fatura_cliente ? 'Faturado' : 'Não faturado',
                "editfr" => $cte[0]->id
            ));
        } else {
            $msg = "Numero de cte inválido";
            echo json_encode(array(
                "msg" => $msg,
                "title" => "OOPS!",
                "icon" => "error"
            ));
        }
    }
    public function drivers()
    {
        $bancos = (new Banco())->find()->fetch(true);
        $drivers = (new Motorista())->find()->order("created_at DESC")->fetch(true);
        $status_conta = (new Status_conta())->find()->fetch(true);
        echo $this->view->render("/dashboard/caminhoneiros", [
            "title" => "Home |Gbs",
            "drivers" => $drivers,
            "bancos" => $bancos,
            "status_conta" => $status_conta
        ]);
    }
    public function fetchDriver($data)
    {
        $drivers = (new Motorista())->findById("{$data["id"]}");

        if (isset($drivers)) {
            echo json_encode(array(
                "id" => $drivers->id,
                "statusconta" => $drivers->status()[0]->status_desc,
                "nome" => $drivers->nome,
                "nomesobrenome" => $drivers->nome . " " . $drivers->sobrenome,
                "sobrenome" => $drivers->sobrenome,
                "email" => $drivers->email,
                "cpf" => $drivers->cpf,
                "rg" => $drivers->rg,
                "cnh" => $drivers->cnh,
                "validadecnh" => $drivers->validade_cnh,
                "phone" => $drivers->telefone1,
                "cep" => $drivers->cep,
                "rua" => $drivers->rua,
                "numero" => $drivers->numero,
                "bairro" => $drivers->bairro,
                "cidade" => $drivers->cidade,
                "estado" => $drivers->estado,
                "mopp" => $drivers->mopp,
                "indivisivel" => $drivers->indivisivel,
                "banco" => $drivers->banco,
                "conta" => $drivers->conta,
                "titular" => $drivers->titular,
                "cpfconta" => $drivers->cpf_conta
            ));
        }
    }
    public function fetchCandidato($data)
    {
        $drivers = (new Motorista())->findById("{$data["id"]}");
        $caminhao = (new Relacao_Caminhao())->find("id_motorista = :idm", "idm={$data["id"]}")->fetch(true);
        if (isset($caminhao)) {

            foreach ($caminhao as $ca) {
                $validade =  new DateTime($ca->caminhao()[0]->validade_renavam);
                $output[] = "<tr><td>{$ca->caminhao()[0]->renavam_caminhao}</td>
                            <td>{$validade->format('d/m/Y')}</td>
                            <td>{$ca->caminhao()[0]->placa_caminhao}</td>
                            <td>{$ca->caminhao()[0]->modelo}</td>
                            <td>{$ca->caminhao()[0]->tipo_caminhao}</td></tr>";
            }
        } else {
            $output = "Sem caminhões cadastrados.";
        }

        $reboque = (new Relacao_Reboque())->find("id_motorista = :idm", "idm={$data["id"]}")->fetch(true);
        if (isset($reboque)) {

            foreach ($reboque as $re) {
                $validade =  new DateTime($re->reboque()[0]->validade_renavam);
                $outputreb[] = "<tr><td>{$re->reboque()[0]->renavam_reboque}</td>
                            <td>{$validade->format('d/m/Y')}</td>
                            <td>{$re->reboque()[0]->tipo_reboque}</td>
                            <td>{$re->reboque()[0]->tipo_reboque}</td></tr>";
            }
        } else {
            $outputreb = "Sem reboques cadastrados";
        }
        if (isset($drivers)) {
            echo json_encode(array(
                "id" => $drivers->id,
                "statusconta" => $drivers->status()[0]->status_desc,
                "nome" => $drivers->nome,
                "nomesobrenome" => $drivers->nome . " " . $drivers->sobrenome,
                "sobrenome" => $drivers->sobrenome,
                "email" => $drivers->email,
                "cpf" => $drivers->cpf,
                "rg" => $drivers->rg,
                "cnh" => $drivers->cnh,
                "validadecnh" => $drivers->validade_cnh,
                "phone" => $drivers->telefone1,
                "cep" => $drivers->cep,
                "rua" => $drivers->rua,
                "numero" => $drivers->numero,
                "bairro" => $drivers->bairro,
                "cidade" => $drivers->cidade,
                "estado" => $drivers->estado,
                "mopp" => $drivers->mopp,
                "indivisivel" => $drivers->indivisivel,
                "banco" => $drivers->banco,
                "conta" => $drivers->conta,
                "titular" => $drivers->titular,
                "cpfconta" => $drivers->cpf_conta,
                "output" => $output,
                "outputreb" => $outputreb
            ));
        }
    }


    public function fetchCaminhao($data)
    {
        $caminhao = (new Relacao_Caminhao())->find("id_motorista = :idm", "idm={$data["id"]}")->fetch(true);
        if (isset($caminhao)) {
            foreach ($caminhao as $ca) {
                $output = " <table class='table table-sm text-center'>
                                <tbody>
                                    <tr class='table-secondary'>
                                            <th>Renavam</th>
                                            <th>Modelo</th>
                                    </tr>
                                    <tr>
                                            <td id='driver_agencia'>{$ca[0]->caminhao()->renavam_caminhao}</td>
                                            <td id='driver_conta'>{$ca[0]->caminhao()->renavam_caminhao}</td>
                                    </tr>
                                </tbody>
                         </table>";
            }
            echo json_encode($output);
        }
    }

    public function membros()
    {
        $nl_acesso = (new Nl_Acesso())->find()->fetch(true);
        $users = (new User())->find()->fetch(true);
        echo $this->view->render("/dashboard/membros", [
            "title" => "Home |Gbs",
            "users" => $users,
            "nl_acesso" => $nl_acesso
        ]);
    }
    public function fetchUser($data)
    {
        $users = (new User())->findById("{$data["id"]}");

        if (isset($users)) {
            echo json_encode(array(
                "id" => $users->id,
                "nome" => $users->nome,
                "nomesobrenome" => $users->nome . " " . $users->sobrenome,
                "sobrenome" => $users->sobrenome,
                "email" => $users->email,
                "contato" => $users->contato,
                "nivel" => $users->nl_acesso()[0]->desc_acesso

            ));
        }
    }

    public function clientes()
    {
        $clients = (new Cliente())->find()->fetch(true);
        echo $this->view->render("/dashboard/clientes", [
            "title" => "Home |Gbs",
            "clients" => $clients
        ]);
    }
    public function fetchCliente($data)
    {
        $clients = (new Cliente())->findById("{$data["id"]}");

        if (isset($clients)) {
            echo json_encode(array(
                "id" => $clients->id,
                "clientname" => $clients->razao_social,
                "razao" => $clients->razao_social,
                "fantasia" => $clients->nome_fantasia,
                "cnpj" => $clients->cnpj,
                "contato" => $clients->contato,
                "cep" => $clients->cep,
                "rua" => $clients->rua,
                "bairro" => $clients->bairro,
                "numero" => $clients->numero,
                "cidade" => $clients->cidade,
                "estado" => $clients->estado,
                "telefone" => $clients->telefone,
                "celular" => $clients->celular,
                "email" => $clients->email,
                "website" => $clients->website,
                "estadual" => $clients->inscricao_estadual
            ));
        }
    }

    public function upgradeUser($data)
    {

        echo $this->view->render("/fragments/geradores/upgradeuser", [
            "title" => "Home |Gbs",
            "data" => $data
        ]);
    }
    //Geradores

    //cliente
    public function novoCliente()
    {
        echo $this->view->render("/fragments/geradores/cliente", [
            "title" => "Novo Cliente"
        ]);
    }
    public function geraCliente($data)
    {
        echo $this->view->render("/fragments/geradores/cria_cliente", [
            "data" => $data
        ]);
    }
    public function geraCliente2($data)
    {
        echo $this->view->render("/fragments/geradores/cria_cliente2", [
            "data" => $data
        ]);
    }
    public function destroyCliente($data)
    {
        echo $this->view->render("/fragments/geradores/exclui_cliente", [
            "data" => $data,
        ]);
    }
    public function upgradeClient($data)
    {
        echo $this->view->render("/fragments/geradores/upgradeClient", [
            "data" => $data,
        ]);
    }

    //caminhao
    public function novoCaminhao()
    {
        $motoristas = (new Motorista())->find()->fetch(true);
        echo $this->view->render("/fragments/geradores/caminhao", [
            "title" => "Novo Caminhão",
            "motoristas" => $motoristas
        ]);
    }
    public function geraCaminhao($data)
    {
        echo $this->view->render("/fragments/geradores/cria_caminhao", [
            "data" => $data
        ]);
    }

    //projeto
    public function novoProjeto()
    {
        $clientes = (new Clients())->find()->fetch(true);
        echo $this->view->render("/fragments/geradores/projeto", [
            "title" => "Home |Gbs",
            "clientes" => $clientes
        ]);
    }
    public function geraProjeto($data)
    {
        echo $this->view->render("/fragments/geradores/cria_projeto", [
            "data" => $data,

        ]);
    }

    //Anuncios

    public function novoAnuncio()
    {
        $clientes = (new Clients())->find()->fetch(true);
        $fornecedores = (new Fornecedores())->find()->fetch(true);
        echo $this->view->render("fragments/geradores/anuncio", [
            "clientes" => $clientes,
            "fornecedores" => $fornecedores
        ]);
    }

    public function geraAnuncio($data)
    {
        echo $this->view->render("/fragments/geradores/cria_anuncio", [
            "data" => $data,
        ]);
    }


    //Faturas

    public function novaFatura()
    {
        $status = (new Build_status())->find()->fetch(true);
        $clientes = (new Clients())->find()->fetch(true);
        $projetos = (new Projetcs())->find()->fetch(true);
        echo $this->view->render("fragments/geradores/faturas", [
            "clientes" => $clientes,
            "status" => $status,
            "projetos" => $projetos
        ]);
    }

    public function geraFatura($data)
    {
        echo $this->view->render("/fragments/geradores/cria_fatura", [
            "data" => $data,
        ]);
    }


    //Usuarios

    public function novoUsuario()
    {
        $admin = (new User())->find("nivel_acesso = 1")->count();
        $users = (new User())->find()->count();
        $operacional = (new User())->find("nivel_acesso = 2")->count();
        $financeiro = (new User())->find("nivel_acesso = 3")->count();
        echo $this->view->render("fragments/geradores/usuarios", [
            "admin" => $admin,
            "operacional" => $operacional,
            "financeiro" => $financeiro,
            "users" => $users
        ]);
    }
    public function geraUsuario($data)
    {
        echo $this->view->render("/fragments/geradores/cria_usuario", [
            "data" => $data,
        ]);
    }
    public function geraUsuario2($data)
    {
        echo $this->view->render("/fragments/geradores/cria_usuario2", [
            "data" => $data,
        ]);
    }
    public function destroyUsuario($data)
    {
        echo $this->view->render("/fragments/geradores/exclui_usuario", [
            "data" => $data,
        ]);
    }


    //Motoristas

    public function novoMotorista()
    {
        $banks = (new Banco())->find()->fetch(true);
        $admin = (new User())->find("nivel_acesso = 1")->count();
        $users = (new User())->find()->count();
        $operacional = (new User())->find("nivel_acesso = 2")->count();
        $financeiro = (new User())->find("nivel_acesso = 3")->count();
        echo $this->view->render("fragments/geradores/motoristas", [
            "admin" => $admin,
            "operacional" => $operacional,
            "financeiro" => $financeiro,
            "users" => $users,
            "banks" => $banks
        ]);
    }
    public function geraMotorista($data)
    {
        echo $this->view->render("/fragments/geradores/cria_motorista", [
            "data" => $data,
        ]);
    }
    public function geraMotorista2($data)
    {
        echo $this->view->render("/fragments/geradores/cria_motorista2", [
            "data" => $data,
        ]);
    }
    public function upgradeDriver($data)
    {

        echo $this->view->render("/fragments/geradores/upgradedriver", [
            "title" => "Home |Gbs",
            "data" => $data
        ]);
    }
    public function destroyMotorista($data)
    {
        echo $this->view->render("/fragments/geradores/exclui_motorista", [
            "data" => $data,
        ]);
    }

    //Credenciais

    public function novaCredencial()
    {
        $clientes = (new Clients())->find()->fetch(true);
        echo $this->view->render("fragments/geradores/credencial", [
            "clientes" => $clientes,
        ]);
    }

    public function geraCredencial($data)
    {
        echo $this->view->render("/fragments/geradores/cria_credencial", [
            "data" => $data,
        ]);
    }


    public function builds()
    {
        //traz as pagas
        $builds_pagas = (new Builds())->find("status = 2")->fetch(true);
        if ($builds_pagas) {
            $pagas = 0;
            foreach ($builds_pagas as $build_paga) {
                $pagas = $build_paga->valor + $pagas;
            }
        } else {
            $pagas = 0;
        }

        //traz as pendentes
        $builds_pendentes = (new Builds())->find("status = 1")->fetch(true);
        if ($builds_pendentes) {
            $pendentes = 0;
            foreach ($builds_pendentes as $build_pendente) {
                $pendentes = $build_pendente->valor + $pendentes;
            }
        } else {
            $pendentes = 0;
        }

        //traz as atrasadas
        $builds_atrasadas = (new Builds())->find("status = 4")->fetch(true);
        if ($builds_atrasadas) {
            $atrasadas = 0;
            foreach ($builds_atrasadas as $builds_atrasada) {
                $atrasadas = $builds_atrasada->valor + $atrasadas;
            }
        } else {
            $atrasadas = 0;
        }

        //traz as canceladas
        $builds_canceladas = (new Builds())->find("status = 3")->fetch(true);
        if ($builds_canceladas) {
            $canceladas = 0;
            foreach ($builds_canceladas as $builds_cancelada) {
                $canceladas = $builds_cancelada->valor + $canceladas;
            }
        } else {
            $canceladas = 0;
        }

        $builds = (new Builds())->find()->order("vencimento ASC")->fetch(true);
        echo $this->view->render("/dashboard/financeiro", [
            "title" => "Home |Gbs",
            "builds" => $builds,
            "pagas" => $pagas,
            "pendentes" => $pendentes,
            "atrasadas" => $atrasadas,
            "canceladas" => $canceladas,
        ]);
    }

    public function editPoject($data)
    {
        $entregas = (new Entregas())->find("id_projeto = :ip", "ip={$data['id']}")->fetch(true);
        $projetcs = (new Projetcs())->find("id = :ie", "ie={$data['id']}")->fetch(true);
        echo $this->view->render("fragments/projetos/edit_project", [
            "project" => $projetcs,
            "entregas" => $entregas
        ]);
    }

    public function editClient($data)
    {
        $usuarios = (new User())->find("id_cliente = :ius", "ius={$data["id"]}")->fetch(true);
        $anuncios = (new Anuncios())->find("id_cliente = :ias", "ias={$data["id"]}")->fetch(true);
        $projetos = (new Projetcs())->find("id_cliente = :idc", "idc={$data["id"]}")->fetch(true);
        $faturas = (new Builds())->find("id_cliente = :idc", "idc={$data["id"]}")->fetch(true);
        $client = (new Clients())->find("id = :ie", "ie={$data['id']}")->fetch(true);
        $credentials = (new Credentials())->find("id_cliente = :iass", "iass={$data['id']}")->fetch(true);

        echo $this->view->render("fragments/clientes/edit_client", [
            "client" => $client,
            "faturas" => $faturas,
            "projetos" => $projetos,
            "anuncios" => $anuncios,
            "users" => $usuarios,
            "credentials" => $credentials
        ]);
    }

    public function geraFsatura($data)
    {
        echo $this->view->render("fragments/clientes/create_build", [
            "data" => $data
        ]);
    }

    public function geraEntrega($data)
    {
        echo $this->view->render("fragments/projetos/create_entrega", [
            "data" => $data
        ]);
    }

    public function fatura()
    {
        echo $this->view->render("dashboard/invoice2", []);
    }


    public function novoFrete()
    {
        echo $this->view->render("fragments/geradores/pre_frete");
    }
    public function geraFrete($data)
    {
        echo $this->view->render("fragments/geradores/cria_frete", [
            "data" => $data
        ]);
    }

    public function editFrete($data)
    {
        $hitory = (new Log_Fretes())->find("frete_id = :fid", "fid={$data["cte"]}")->order("created_at DESC")->fetch(true);
        $clientes = (new Cliente())->find()->fetch(true);
        $motoristas = (new Motorista())->find()->fetch(true);
        $status = (new Status_frete())->find()->fetch(true);
        $status_candidatura = (new Status_candidatura())->find()->fetch(true);
        $frete = (new Frete())->find("id = :fid", "fid={$data['cte']}")->fetch(true);
        $docfrete = (new Docfrete())->find("id_frete = :idf", "idf={$data['cte']}")->fetch(true);
        $candidaturas = (new Candidaturas())->find("frete_id = :fid", "fid={$data["cte"]}")->fetch(true);
        $n_candidatos = (new Candidaturas())->find("frete_id = :fid", "fid={$data["cte"]}")->count();
        $cidades = (new Cidades())->find()->fetch(true);
        echo $this->view->render("fragments/geradores/frete", [
            "frete" => $frete,
            "status" => $status,
            "motoristas" => $motoristas,
            "clientes" => $clientes,
            "cidades" => $cidades,
            "history" => $hitory,
            "candidaturas" => $candidaturas,
            "n_candidatos" => $n_candidatos,
            "status_candidatura" =>  $status_candidatura,
            "docfrete" => $docfrete
        ]);
    }
    public function newDocfrete($data){
        echo $this->view->render("fragments/frete/novo_docfrete", [
            "data" => $data
        ]);

    }
    public function editStatus($data)
    {
        echo $this->view->render("fragments/frete/altera_status", [
            "data" => $data
        ]);
    }


    public function editMotorista($data)
    {
        echo $this->view->render("fragments/frete/altera_motorista", [
            "data" => $data
        ]);
    }

    public function editFreteCliente($data)
    {
        echo $this->view->render("fragments/frete/altera_cliente", [
            "data" => $data
        ]);
    }
    public function editOperacao($data)
    {
        echo $this->view->render("fragments/frete/altera_operacao", [
            "data" => $data
        ]);
    }


    public function editGeral($data)
    {
        echo $this->view->render("fragments/frete/altera_geral", [
            "data" => $data
        ]);
    }

    public function alteraCandidatura($data)
    {
        echo $this->view->render("fragments/frete/altera_candidatura", [
            "data" => $data
        ]);
    }
    public function dompdf()
    {
        echo $this->view->render("fragments/frete/gerarpdf");
    }
}
