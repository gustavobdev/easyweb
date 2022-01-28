<!DOCTYPE html>
<html>

<head>
  <title>Teste</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <style>
    table {
      border: 1px solid #ccc;
      background-color: #f8f8f8;
      margin: 0;
      padding: 3;
      width: 100%;
      table-layout: fixed;
    }

    table .left {
      position: absolute;
      margin: left;
    }

    table caption {
      font-size: 1.0em;
      margin: .5em 0 .75em;
      text-transform: uppercase;
    }

    table tr {
      border: 1px solid #ddd;
      padding: .35em;
    }

    table th,
    table td {
      padding: .425em;
      text-align: center;
    }

    table th {
      font-size: .85em;
      letter-spacing: .1em;
      text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
      table {
        border: 0;
      }

      table caption {
        font-size: 1.3em;
      }

      table thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 0.1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }

      table tr {
        border-bottom: 3px solid #ddd;
        display: block;
        margin-bottom: .425em;
      }

      table td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: .8em;
        text-align: right;
      }

      table td::before {
        /*
    * aria-label has no advantage, it wont be read inside a table
    content: attr(aria-label);
    */
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
      }

      table td:last-child {
        border-bottom: 0;
      }
    }

    /* general styling */
    body {
      font-family: "Open Sans", sans-serif;
      line-height: 1.25;
    }
  </style>
  <?php

  use Source\Models\Motorista;
  use Source\Models\Frete;

  $frete = (new Frete())->findById(IDFRETE);
  $motorista = (new Motorista())->findById($frete->motorista);

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
  ?>
  <div class="col-sm-12">
    <div class="col-sm-6" style="float: right; position:  responsive; ">
      <img src="<?= url("assets/img/invoice.png") ?>" width="150px" alt="image" />
    </div>

    <table style="width:30%">
      <thead>
        <tr>
          <th scope="col">Ref/CTE</th>
          <th scope="col">Data</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Ref/CTE"><?= $frete->id . ' / ' . $frete->doc_viagem_cte ?></td>
          <td data-label="Data"><?= $dvenda ?></td>
        </tr>
      </tbody>
    </table>
    <table>
      <caption>Informações do Frete</caption>
      <thead>
        <tr>
          <th scope="col">QTD.VG</th>
          <th scope="col">CONTROLE INTERNO</th>
          <th scope="col">MODALIDE</th>
          <th scope="col">CLIENTE/TRANSPORTADORA</th>
          <th scope="col">REF.CLIENTE</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="QTD.VG"><?= $frete->qde_vg ?></td>
          <td data-label="CONTROLE INTERNO"><?= $frete->controle_interno ?></td>
          <td data-label="MODALIDE"><?= $frete->agenciamento_ou_cliente ?></td>
          <td data-label="CLIENTE/TRANSPORTADORA"><?= $frete->clientes()[0]->razao_social ?></td>
          <td data-label="REF.CLIENTE"><?= $frete->ref_cliente ?></td>
        </tr>
        <tr>
          <th scope="col">TIPO</th>
          <th scope="col">SIZE</th>
          <th scope="col">TIPO</th>
          <th scope="col">IMO</th>
          <th scope="col">CONTAINER/QTE.LCL</th>
        </tr>
        <tr>
          <td data-label="TIPO"><?= $frete->exp_di_dta ?></td>
          <td data-label="SIZE"><?= $frete->size ?></td>
          <td data-label="TIPO"><?= $frete->tipo ?></td>
          <td data-label="IMO"><?= $imo ?></td>
          <td data-label="CONTAINER/QTE.LCL"><?= $frete->container_qnt_carga_solta ?></td>
        </tr>
        <tr>
          <th scope="col">RASTREADO</th>
          <th scope="col">DI/DTA/NF</th>
          <th scope="col">MARCADORIA/PRODUTO</th>
          <th scope="col">PESO TOTAL</th>
          <th scope="col">VALOR CIF R$</th>
        </tr>
        <tr>
          <td data-label="RASTREADO"><?= $rastreado ?></td>
          <td data-label="DI/DTA/NF"><?= $frete->ndi_dta_reserva_nf ?></td>
          <td data-label="MARCADORIA/PRODUTO"><?= $frete->mercadoria_produto ?></td>
          <td data-label="PESO TOTAL"><?= $frete->peso_total ?></td>
          <td data-label="VALOR CIF R$"><?= $frete->peso_total ?></td>
        </tr>
      </tbody>
    </table>
    <table>
      <caption>Informações do Motorista</caption>
      <thead>
        <tr>
          <th scope="col">NOME</th>
          <th scope="col">CPF</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="NOME"><?= $frete->motoristas()[0]->nome . ' ' . $frete->motoristas()[0]->sobrenome ?></td>
          <td data-label="CPF"><?= $str ?></td>
        </tr>
        <tr>
          <th scope="col">PLACA</th>
          <th scope="col">RENAVAM</th>
          <th scope="col">MODELO</th>
          <th scope="col">COR</th>
          <th scope="col">TIPO</th>
        </tr>
        <tr>
          <td data-label="PLACA"><?= $motorista->caminhao()[0]->placa_caminhao ?></td>
          <td data-label="RENAVAM"><?= $motorista->caminhao()[0]->renavam_caminhao ?></td>
          <td data-label="MODELO"><?= $motorista->caminhao()[0]->modelo ?></td>
          <td data-label="COR"><?= $motorista->caminhao()[0]->cor ?></td>
          <td data-label="TIPO"><?= $caminhaoTipo ?></td>
        </tr>
        <tr>
          <th scope="col">PLACA REBOQUE</th>
          <th scope="col">RENAVAM</th>
          <th scope="col">TIPO REBOQUE</th>
        </tr>
        <tr>
          <td data-label="PLACA REBOQUE"><?= $motorista->reboque()[0]->placa_reboque ?></td>
          <td data-label="RENAVAM"><?= $motorista->reboque()[0]->renavam_reboque ?></td>
          <td data-label="TIPO REBOQUE"><?= $reboqueTipo ?></td>
        </tr>
      </tbody>
    </table>
    <table>
      <caption>Informações Operacionais</caption>
      <thead>
        <tr>
          <th scope="col">CDA TERMINAL COLETA</th>
          <th scope="col">SDA TERMINAL COLETA</th>
          <th scope="col">CDA CLIENTE</th>
          <th scope="col">SDA CLIENTE</th>
          <th scope="col">DEV VAZIO/BEM. CHEIO</th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td data-label="CDA TERMINAL COLETA"><?= $cda_terminal_coleta ?></td>
          <td data-label="SDA TERMINAL COLETA"><?= $sda_terminal_coleta ?></td>
          <td data-label="CDA CLIENTE"><?= $cda_cliente ?></td>
          <td data-label="SDA CLIENTE"><?= $sda_cliente ?></td>
          <td data-label="DEV VAZIO/BEM. CHEIO"><?= $devolucao_vazio ?></td>
        </tr>
      </tbody>
    </table>
</body>

</html>