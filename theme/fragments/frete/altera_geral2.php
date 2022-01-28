<?php

use CoffeeCode\Router\Router;
use Source\Models\Frete;
use Source\Models\Cidades;
use Dompdf\Dompdf;
use Dompdf\Options;
use Source\Models\Motorista;

$router = new Router(URL_BASE);

$relacao1 = (new Cidades())->find("nome = :mot", "mot={$data['origem_cidade']}")->fetch(true);
$relacao2 = (new Cidades())->find("nome = :mot", "mot={$data['retirada_cheio_vazio_cidade']}")->fetch(true);
$relacao3 = (new Cidades())->find("nome = :mot", "mot={$data['destino_cidade']}")->fetch(true);
$relacao4 = (new Cidades())->find("nome = :mot", "mot={$data['dep_ch_vz_cidade']}")->fetch(true);

$frete = (new Frete())->findById($data["id_principal"]);
$motorista = (new Motorista())->findById($frete->motorista);

$frete->qde_vg = $data['qde_vg'];
$frete->data_venda = $data['data_venda'];
$frete->controle_interno = $data['controle_interno'];
$frete->agenciamento_ou_cliente = $data['tipo_categoria'];
$frete->importador = $data['importador'];
$frete->exp_di_dta = $data['exp_di_dta'];
$frete->dimensao = $data['dimensao'];
$frete->size = $data['dimensao'];
$frete->tipo = $data['tipo'];
$frete->imo = $data['imo'];
$frete->rastreado = $data['rastreado'];
$frete->ref_cliente = $data['ref_cliente'];
$frete->ndi_dta_reserva_nf = $data['ndi_dta_reserva_nf'];
$frete->container_qnt_carga_solta = $data['container_qnt_carga_solta'];
$frete->mercadoria_produto = $data['mercadoria_produto'];
$frete->peso_total = $data['peso_total'];
$frete->valor_cif = $data['valor_cif'];


$frete->origem_cidade = $relacao1[0]->id;
$frete->origem_uf = $data['origem_uf'];

$frete->retirada_cheio_vazio_cidade = $relacao2[0]->id;
$frete->retirada_cheio_vazio_uf = $data['retirada_cheio_vazio_uf'];

$frete->destino_cidade = $relacao3[0]->id;
$frete->destino_uf = $data['destino_uf'];

$frete->deposito_cheio_vazio_cidade = $relacao4[0]->id;
$frete->deposito_cheio_vazio_uf = $data['dep_ch_vz_uf'];


$frete->doc_viagem_cte = $data['doc_viagem_cte'];
$frete->frete_motorista = $data['frete_motorista'];
$frete->custo_extra = $data['custo_extra'];
$frete->adiantamento = $data['adiantamento'];
$frete->tipo_transacao = $data['tipo_transacao'];
$frete->data_adiantamento = $data['data_adiantamento'];
$frete->frete_saldo = $data['frete_saldo'];
$frete->tipo_transacao_saldo = $data['tipo_transacao_saldo'];
$frete->data_saldo = $data['data_saldo'];
$frete->obs_frete_motorista = $data['obs_frete_motorista'];
$frete->n_fatura_cliente = $data['n_fatura_cliente'];
$frete->valor_cliente = $data['valor_cliente'];
$frete->data_boleto = $data['data_boleto'];
$frete->obs_cliente = $data['obs_cliente'];
$frete->save();

session_start();
if ($frete->save()) {
    if (isset($data['scales'])) {
        /********CONVERSÃO DE DATAS **********/
        $data_venda = new DateTime($frete->data_venda);
        $dvenda = $data_venda->format("d/m/Y");

        if (isset($frete->cda_terminal_coleta)) {
            $cdaterminal_coleta = new DateTime($frete->cda_terminal_coleta);
            $cda_terminal_coleta = $cdaterminal_coleta->format("d/m/Y - H:i");
        } else {
            $cda_terminal_coleta = "N/A";
        }

        if (isset($frete->sda_terminal_coleta)) {
            $sdaterminal_coleta = new DateTime($frete->sda_terminal_coleta);
            $sda_terminal_coleta = $sdaterminal_coleta->format("d/m/Y - H:i");
        } else {
            $sda_terminal_coleta = "N/A";
        }

        if (isset($frete->cda_cliente)) {
            $cdacliente = new DateTime($frete->cda_cliente);
            $cda_cliente = $cdacliente->format("d/m/Y - H:i");
        } else {
            $cda_cliente = "N/A";
        }

        if (isset($frete->sda_cliente)) {
            $sdacliente = new DateTime($frete->sda_cliente);
            $sda_cliente = $sdacliente->format("d/m/Y - H:i");
        } else {
            $sda_cliente = "N/A";
        }

        if (isset($frete->devolucao_vazio)) {
            $devolucaovazio = new DateTime($frete->devolucao_vazio);
            $devolucao_vazio = $devolucaovazio->format("d/m/Y - H:i");
        } else {
            $devolucao_vazio = "N/A";
        }
        /*****************************************************/

        /**RESTRINGINDO 4 ULTIMOS N DE CPF */
        $str = strrev(preg_replace('/\d/', '*',  strrev($frete->motoristas()[0]->cpf), 4));
        /** */

        /**VERIFICA RESPOSTAS S/N */
        $imo = $frete->imo == "1" ? "SIM" : "NÃO";
        $rastreado = $frete->rastreado == "1" ? "SIM" : "NÃO";
        /** */

        /**VERIFICA TIPO BAU / REBOQUE */
        $caminhaoTipo = $motorista->caminhao()[0]->tipo_caminhao == "1" ? "CAVALO" : "BAÚ";
        $reboqueTipo = $motorista->reboque()[0]->tipo_reboque == "1" ? "CAVALO" : "BAÚ";
        /** */
        $html = '<style>
        table {
        border: 2px solid #ccc;
        border-collapse: collapse;
        margin: 5;
        padding: 5;
        width: 100%;
        table-layout: responsive;
        }
        table th,
table td {
  
  text-align: center;
}
        </style>
        
        <div class="col-sm-12">
        <div class="col-sm-6">
            <img src="' . url("assets/img/invoice.png") . '" width="150px" alt="image"/>
        </div>
        <table style="width:30%;">
            <tr>
                <th>Ref / CTE</th>
                <th>Data</th>
            </tr>
            <tr>
                <td>' . $frete->id . ' / ' . $frete->doc_viagem_cte . '</td>
                <td>' . $dvenda  . '</td>
            </tr>

        </table>
        </div>

        <table>
        <tbody>
        <tr>
            <th >QTD. VG</th>
            <th>CONTROLE INTERNO</th>
            <th>MODALIDE</th>
            <th >CLIENTE / TRANSPORTADORA</th>
        </tr>
        <tr>
            <td>' . $frete->qde_vg . '</td>
            <td>' . $frete->controle_interno . '</td>
            <td class="">' . $frete->agenciamento_ou_cliente . '</td>
            <td>' . $frete->clientes()[0]->razao_social . '</td>
        </tr>
        <tr>
            <th>TIPO</th>
            <th>SIZE</th>
            <th>TIPO</th>
            <th>IMO</th>
            <th>CONTAINER / QTE.LCL</td>
            <th>RASTREADO</th>
            <th>REF.CLIENTE</th>
        </tr>
        <tr>
            <td>' . $frete->exp_di_dta . '</td>
            <td>' . $frete->size . '</td>
            <td>' . $frete->tipo . '</td>
            <td class="">' . $imo .  '</td>
            <td class="">' . $frete->container_qnt_carga_solta . '</td>
            <td class="">' . $rastreado . '</td>
            <td>' . $frete->ref_cliente . '</td>
        </tr>
        <tr>
            <th>DI / DTA / NF</th>
            <th>MARCADORIA / PRODUTO</th>
            <th>PESO TOTAL</th>
            <th>VALOR CIF R$</th>
        </tr>
        <tr>
            <td >' . $frete->ndi_dta_reserva_nf . '</td>
            <td>' . $frete->mercadoria_produto . '</td>
            <td>' . $frete->peso_total . '</td>
            <td>' . $frete->valor_cif . '</td>
        </tr>

        </tbody>
        </table>


        <table style="border: 0px solid">
        <tbody>
        <tr >
        <th>
        INFORMAÇÕES DO MOTORISTA
        </th>
        </tr>
        </tbody>
        </table>

        <table>
        <tbody>
        <tr>
            <th>NOME</th>
            <th>CPF</th>
        </tr>
        <tr>
         <td>' . $frete->motoristas()[0]->nome . ' ' . $frete->motoristas()[0]->sobrenome . '</td>
            <td>' . $str . '</td>
        </tr>
        <tr>
            <th>PLACA DO CAMINHÃO</th>
            <th>RENAVAM</th>
            <td>MODELO</th>
           <th>COR</th>
            <th>TIPO</th>
        </tr>
        <tr>

            <td>' . $motorista->caminhao()[0]->placa_caminhao . '</td>
            <td>' . $motorista->caminhao()[0]->renavam_caminhao . '</td>
            <td>' . $motorista->caminhao()[0]->modelo . '</td>
            <td>' . $motorista->caminhao()[0]->cor . '</td>
            <td>' . $caminhaoTipo . '</td>
        </tr>
        <tr>
            <th>PLACA DO REBOQUE</th>
            <th style="width=40%">RENAVAM</th>
            <th>TIPO REBOQUE</th>
        </tr>
        <tr>
            <td>' . $motorista->reboque()[0]->placa_reboque . '</td>
            <td>' . $motorista->reboque()[0]->renavam_reboque . '</td>
            <td>' . $reboqueTipo . '</td>
        </tr>

        </tbody>
        </table>

        <table style="border: 0px solid">
        <tbody>
        <tr >
        <th>
            INFORMAÇÕES OPERACIONAIS
        </th>
        </tr>
        </tbody>
        </table>

        <table>
        <tbody>
        <tr>
            <th>CDA TERMINAL COLETA</th>
            <th>SDA TERMINAL COLETA</th>
            <th>CDA CLIENTE</th>
            <th>SDA CLIENTE</th>
            <th>DEV VAZIO/BEM. CHEIO</th>
        </tr>
        <tr>
            <td>' . $cda_terminal_coleta . '</td>
            <td>' . $sda_terminal_coleta . '</td>
            <td>' . $cda_cliente . '</td>
            <td>' . $sda_cliente . '</td>
            <td>' .  $devolucao_vazio . '</td>
        </tr>

        </tbody>
        </table>';

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper("A4", "landscape");
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('filename.pdf', $output);
    }
    $_SESSION["success_frete"] = "Alterações gerais feitas com sucesso!";
} else {
    $_SESSION["decline_frete"] = "Erro na solicitação!";
}
$router->redirect("console/fretes/{$data["id_principal"]}");
die();
