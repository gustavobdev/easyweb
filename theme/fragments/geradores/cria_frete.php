<?php

use CoffeeCode\Router\Router;
use Source\Models\Frete;
use Source\Models\Log_Fretes;
use Source\Models\Operacional;

$router = new Router(URL_BASE);

if(!isset($_SESSION)){
    session_start();
}
if(empty($data["cte"]) xor is_null($data["cte"])){
    $data["cte"] = "vazio";
}
$verfrete = (new Frete())->find("doc_viagem_cte = :doc","doc={$data["cte"]}")->fetch(true);
if($verfrete){
    $msg = "este número de CTE já existe!";
    echo json_encode(array(
        "msg" => $msg,
        "icon" => "error",
        "title" => "OOPS!"
    ));
die();
}
if($data["cte"] === "vazio"){
    $data["cte"] = null;
}
$build = new Frete();
//$build->ref = null;
//$build->data_venda = null;
//$build->qde_vg = null;
//$build->controle_interno = null;
//$build->agenciamento_ou_cliente = null;
//$build->cliente_transportadora = null;
//$build->importador = null;
//$build->exp_di_dta = null;
//$build->dimensao = null;
//$build->size = null;
//$build->tipo = null;
//$build->imo = null;
//$build->rastreado = null;
//$build->ref_cliente = null;
//$build->ndi_dta_reserva_nf = null;
//$build->container_qnt_carga_solta = null;
//$build->peso_total = null;
//$build->valor_cif  = null;
//$build->origem_cidade = null;
//$build->origem_uf = null;
//$build->retirada_cheio_vazio_cidade = null;
//$build->retirada_cheio_vazio_uf = null;
//$build->destino_uf = null;
//$build->deposito_cheio_vazio_cidade = null;
//$build->deposito_cheio_vazio_uf = null;
//$build->motorista = null;
//$build->operacional = null;
//$build->mercadoria_produto = null;
//$build->mercadoria_produto = null;
//$build->mercadoria_produto = null;
$build->status_frete = 1;
$build->doc_viagem_cte = $data["cte"];
$build->save();

if($build->save() != false){
    $logfrete = new Log_Fretes();
    $logfrete->frete_id = $build->id;
    $logfrete->user_id = $_SESSION["user_id"];
    $logfrete->campo = "Criação do CTE";
    $logfrete->val_antigo = "Vazio";
    $logfrete->val_novo = "CTE ID: {$build->id}";
    $logfrete->save();
    $msg = "CTE Criado com sucesso!";
   // $router->redirect("/console/fretes");
   echo json_encode(array(
       "msg" => $msg,
       "icon" => "success",
       "title" => "Feito!",
       "frete" => url("/console/fretes/").$build->id
   ));
}else{
    $msg = "Ocorreu algum erro na criação do CTE!";
    echo json_encode(array(
        "msg" => $msg,
        "icon" => "error",
        "title" => "OOPS!"
    ));
   // $router->redirect("/console/fretes");
}


